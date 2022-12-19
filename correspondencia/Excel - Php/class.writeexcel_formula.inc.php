<?php

/*
 * Copyleft 2002 Johann Hanne
 *
 * This is free software; you can redistribute it and/or
 * modify it under the terms of the GNU Lesser General Public
 * License as published by the Free Software Foundation; either
 * version 2.1 of the License, or (at your option) any later version.
 *
 * This software is distributed in the hope that it will be useful,
 * but WITHOUT ANY WARRANTY; without even the implied warranty of
 * MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the GNU
 * Lesser General Public License for more details.
 *
 * You should have received a copy of the GNU Lesser General Public
 * License along with this software; if not, write to the
 * Free Software Foundation, Inc., 59 Temple Place,
 * Suite 330, Boston, MA  02111-1307 USA
 */

/*
 * This is the Spreadsheet::WriteExcel Perl package ported to PHP
 * Spreadsheet::WriteExcel was written by John McNamara, jmcnamara@cpan.org
 */

class writeexcel_formula {

###############################################################################
#
# Class data.
#
var $parser;
var $ptg;
var $functions;
var $_debug;
var $_byte_order;
var $_volatile;
var $_workbook;
var $_ext_sheets;

###############################################################################
#
# new()
#
# Constructor
#
function writeexcel_formula($byte_order) {

    $this->parser          = false;
    $this->ptg             = array();
    $this->functions       = array();
    $this->_debug          = 0;
    $this->_byte_order     = $byte_order;
    $this->_volatile       = 0;
    $this->_workbook       = "";
    $this->_ext_sheets     = array();
}

###############################################################################
#
# _init_parser()
#
# There is a small overhead involved in generating the parser. Therefore, the
# initialisation is delayed until a formula is required. TODO: use a pre-
# compiled header.
#
function _init_parser() {

    $this->_initialize_hashes();

    # The parsing grammar.
    #
    # TODO: Add support for international versions of Excel
    #
//TODO
/*
    $this->parser = Parse::RecDescent->new(<<'EndGrammar');

        expr:           list

        # Match arg lists such as SUM(1,2, 3)
        list:           <leftop: addition ',' addition>
                        { [ $item[1], '_arg', scalar @{$item[1]} ] }

        addition:       <leftop: multiplication add_op multiplication>

        # TODO: The add_op operators don't have equal precedence.
        add_op:         add |  sub | concat
                        | eq | ne | le | ge | lt | gt   # Order is important

        add:            '+'  { 'ptgAdd'    }
        sub:            '-'  { 'ptgSub'    }
        concat:         '&'  { 'ptgConcat' }
        eq:             '='  { 'ptgEQ'     }
        ne:             '<>' { 'ptgNE'     }
        le:             '<=' { 'ptgLE'     }
        ge:             '>=' { 'ptgGE'     }
        lt:             '<'  { 'ptgLT'     }
        gt:             '>'  { 'ptgGT'     }


        multiplication: <leftop: exponention mult_op exponention>

        mult_op:        mult  | div
        mult:           '*' { 'ptgMul' }
        div:            '/' { 'ptgDiv' }

        # Right associative
        exponention:    <rightop: factor exp_op factor>

        exp_op:         '^' { 'ptgPower' }

        factor:         number       # Order is important
                        | string
                        | range2d
                        | range3d
                        | true
                        | false
                        | ref2d
                        | ref3d
                        | function
                        | '(' expr ')'  { [$item[2], 'ptgParen'] }

        # Match a string.
        # TODO: Define a regex or subrule to handle embedded quotes.
        #
        string:         /"[^"]*"/     #" For editors
                        { [ '_str', $item[1]] }

        # Match float or integer
        number:          /([+-]?)(?=\d|\.\d)\d*(\.\d*)?([Ee]([+-]?\d+))?/
                        { ['_num', $item[1]] }

        #
        # The highest column values is IV. The following regexes match to IZ.
        # Out of range values are caught in the code.
        #

        # Match A1, $A1, A$1 or $A$1.
        ref2d:           /\$?[A-I]?[A-Z]\$?\d+/
                        { ['_ref2d', $item[1]] }

        # Match an external sheet reference.
        # A Sheetname with a comma must be in single quotes: 'Sheet, 1'.
        #
        ref3d:          /([^':!(,]+:)?[^':!(,]+[!]\$?[A-I]?[A-Z]\$?\d+/
                        { ['_ref3d', $item[1]] }
                        |/[']?([^':!(]+:)?[^':!(]+[']?[!]\$?[A-I]?[A-Z]\$?\d+/
                        { ['_ref3d', $item[1]] }

        # Match A1:C5 etc.
        range2d:          /\$?[A-I]?[A-Z]\$?\d+:\$?[A-I]?[A-Z]\$?\d+/
                        { ['_range2d', $item[1]] }

        # Match an external sheet range.
        # A Sheetname with a comma must be in single quotes: 'Sheet, 1'.
        #
        range3d:        /([^':!(,]+:)?[^':!(,]+[!]\$?[A-I]?[A-Z]\$?\d+:\$?[A-I]?[A-Z]\$?\d+/
                        { ['_range3d', $item[1]] }
                        |/[']([^':!(]+:)?[^':!(]+['][!]\$?[A-I]?[A-Z]\$?\d+:\$?[A-I]?[A-Z]\$?\d+/
                        { ['_range3d', $item[1]] }

        # Match a function -name.
        function:       /[A-Z0-9À-Ü_.]+/ '()'
                        { ['_func', $item[1]] }
                        | /[A-Z0-9À-Ü_.]+/ '(' expr ')'
                        { ['_class', $item[1], $item[3], '_func', $item[1]] }
                        | /[A-Z0-9À-Ü_.]+/ '(' list ')'
                        { ['_class', $item[1], $item[3], '_func', $item[1]] }

        # Boolean values.
        true:           'TRUE'  { [ 'ptgBool', 1 ] }

        false:          'FALSE' { [ 'ptgBool', 0 ] }

EndGrammar
*/

    if ($this->_debug) {
        print "Init_parser.\n\n";
    }
}

###############################################################################
#
# parse_formula()
#
# This is the only public method. It takes a textual description of a formula
# and returns a RPN encoded byte string.
#
function parse_formula() {

    $_=func_get_args();

    # Initialise the parser if this is the first call
    if ($this->parser===false) {
        $this->_init_parser();
    }

    $formula = array_shift($_);
    //$str;
    //$tokens;

    if ($this->_debug) {
        print "$formula\n";
    }

    # Build the parse tree for the formula
    $parsetree = $this->parser->expr($formula);

    # Check if parsing worked.
    if ($parsetree!==false) {
        $tokens = $this->_reverse_tree($parsetree);

        # Convert parsed tokens to a byte stream
        $str = $this->_parse_tokens($tokens);
        $tokens = join (" ", $tokens); # For debugging
    } else {
        trigger_error("Couldn't parse formula: $formula", E_USER_ERROR);
    }

    # Prepend the volatile attribute if the function is volatile.
    # Then reset the volatile flag.
    #
    if ($this->_volatile) {
        $str = $this->_add_volatile() . $str;
    }
    $this->_volatile = 0;

    if ($this->_debug) {
//todo
//        print join(" ", map { sprintf "%02X", $_ } unpack("C*",$str)), "\n";
//        print $tokens, "\n\n";
    }

    return $str;
}

###############################################################################
#
#  _reverse_tree()
#
# This function descends recursively through the parse tree. At each level it
# swaps the order of an operator followed by an operand.
# For example, 1+2*3 would be converted in the following sequence:
#               1 + 2 * 3
#               1 + (2 * 3)
#               1 + (2 3 *)
#               1 (2 3 *) +
#               1 2 3 * +
#
function _reverse_tree($expression) {

    $tokens=array();
    $stack=array();

    while (sizeof($expression)>0) {
        $token = array_shift($expression);

        # If the token is an operator swap it with the following operand
        if (    $token == 'ptgAdd'      ||
                $token == 'ptgSub'      ||
                $token == 'ptgConcat'   ||
                $token == 'ptgMul'      ||
                $token == 'ptgDiv'      ||
                $token == 'ptgPower'    ||
                $token == 'ptgEQ'       ||
                $token == 'ptgNE'       ||
                $token == 'ptgLE'       ||
                $token == 'ptgGE'       ||
                $token == 'ptgLT'       ||
                $token == 'ptgGT') {
            $operand = array_shift ($expression);
            array_push($stack, $operand);
        }

        array_push($stack, $token);
    }

    # Recurse through the parse tree
    foreach ($stack as $token) {
        if (is_array($token)) {
            array_push($tokens, $this->_reverse_tree($token));
        } else {
            array_push($tokens, $token);
        }
    }

    return $tokens;
}

###############################################################################
#
# _parse_tokens()
#
# Convert each token or token pair to its Excel 'ptg' equivalent.
#
function _parse_tokens() {

    $_=func_get_args();

    $parse_str   = '';
    $last_type   = '';
    $num_args    = 0;
    $class       = 0;
    $classes       = array(1);

    while (strlen($_)>0) {
        $token = array_shift($_);

        if ($token == '_arg') {
            $num_args = array_shift($_);
        } elseif ($token == '_class') {
            $token = array_shift($_);
            $class = $this->functions[$token][2];
            array_push($classes, $class);
        } elseif ($token == 'ptgBool') {
            $token = array_shift($_);
            $parse_str .= $this->_convert_bool($token);
        } elseif ($token == '_num') {
            $token = array_shift($_);
            $parse_str .= $this->_convert_number($token);
        } elseif ($token == '_str') {
            $token = array_shift($_);
            $parse_str .= $this->_convert_string($token);
        } elseif ($token == '_ref2d') {
            $token = array_shift($_);
            $parse_str .= $this->_convert_ref2d($token, $classes[sizeof($classes)-1]);
        } elseif ($token == '_ref3d') {
            $token = array_shift($_);
            $parse_str .= $this->_convert_ref3d($token, $classes[sizeof($classes)-1]);
        } elseif ($token == '_range2d') {
            $token = array_shift($_);
            $parse_str .= $this->_convert_range2d($token, $classes[sizeof($classes)-1]);
        } elseif ($token == '_range3d') {
            $token = array_shift($_);
            $parse_str .= $this->_convert_range3d($token, $classes[sizeof($classes)-1]);
        } elseif ($token == '_func') {
            $token = array_shift($_);
            $parse_str .= $this->_convert_function($token, $num_args);
            array_pop($classes);
        } elseif (isset($this->ptg[$token])) {
            $parse_str .= pack("C", $this->ptg[$token]);
        } else {
            print("Unrecognised token: $token ");
        }
    }

    return $parse_str;
}

###############################################################################
#
# _add_volatile()
#
# Returns a ptgAttr tag formatted to indicate that the formula contains a
# volatile function, i.e. a function that must be recalculated each time a cell
# is updated. Examples: RAND(), NOW(), TIME()
#
function _add_volatile() {

    # Set bitFattrSemi flag to indicate volatile function, "w" is set to zero.
    return pack("CCv", $this->ptg[ptgAttr], 0x1, 0x0);
}

###############################################################################
#
# _convert_bool()
#
# Convert a boolean token to ptgBool
#
function _convert_bool($bool) {

    return pack("CC", $this->ptg[ptgBool], $bool);
}

###############################################################################
#
# _convert_number()
#
# Convert a number token to ptgInt or ptgNum
#
function _convert_number($num) {

    # Integer in the range 0..2**16-1
    if (preg_match('/^\d+$/', $num) && ($num <= 65535)) {
        return pack("Cv", $this->ptg[ptgInt], $num);
    } else {
        # A float
        $num = pack("d", $num);
        if ($this->_byte_order) {
            $num = array_reverse ($num);
        }
        return pack("C", $this->ptg[ptgNum]) . $num;
    }
}

###############################################################################
#
# _convert_string()
#
# Convert a string to a ptg Str.
#
function _convert_string($str) {

    $str = preg_replace('/^"/', '', $str) ;   # Remove leading  "
    $str = preg_replace('/"$/', '', $str) ;   # Remove trailing "
    $str = preg_replace('/""/', '"', $str); # Substitute Excel's escaped double quote "" for "

    $length = strlen($str);
    if ($length > 255) {
        trigger_error("String: $str greater than 255 chars", E_USER_ERROR);
    }

    return pack("CC", $this->ptg[ptgStr], $length) . $str;
}

###############################################################################
#
# _convert_ref2d()
#
# Convert an Excel reference such as A1, $B2, C$3 or $D$4 to a ptgRefV.
#
function _convert_ref2d($cell, $class) {

    //$ptgRef;

    # Convert the cell reference
    list($row, $col) = $this->_cell_to_packed_rowcol($cell);

    # The ptg value depends on the class of the ptg.
    if ($class == 0) {
        $ptgRef = pack("C", $this->ptg[ptgRef]);
    } elseif ($class == 1) {
        $ptgRef = pack("C", $this->ptg[ptgRefV]);
    } elseif ($class == 2) {
        $ptgRef = pack("C", $this->ptg[ptgRefA]);
    } else{
        trigger_error("Unknown class", E_USER_ERROR);
    }

    return $ptgRef . $row . $col;
}

###############################################################################
#
# _convert_ref3d
#
# Convert an Excel 3d reference such as "Sheet1!A1" or "Sheet1:Sheet2!A1" to a
# ptgRef3dV.
#
function _convert_ref3d($token, $class) {

    //$ptgRef;

    # Split the ref at the ! symbol
    list($ext_ref, $cell) = preg_split('!', $token);

    # Convert the external reference part
    $ext_ref = $this->_pack_ext_ref($ext_ref);

    # Convert the cell reference part
    list($row, $col) = $this->_cell_to_packed_rowcol($cell);

    # The ptg value depends on the class of the ptg.
    if ($class == 0) {
        $ptgRef = pack("C", $this->ptg[ptgRef3d]);
    } elseif ($class == 1) {
        $ptgRef = pack("C", $this->ptg[ptgRef3dV]);
    } elseif ($class == 2) {
        $ptgRef = pack("C", $this->ptg[ptgRef3dA]);
    } else{
        trigger_error("Unknown class", E_USER_ERROR);
    }

    return $ptgRef . $ext_ref. $row . $col;
}

###############################################################################
#
# _convert_range2d()
#
# Convert an Excel range such as A1:D4 to a ptgRefV.
#
function _convert_range2d($range, $class) {

    //$ptgArea;

    # Split the range into 2 cell refs
    list($cell1, $cell2) = preg_split(':', $range);

    # Convert the cell references
    list($row1, $col1) = $this->_cell_to_packed_rowcol($cell1);
    list($row2, $col2) = $this->_cell_to_packed_rowcol($cell2);

    # The ptg value depends on the class of the ptg.
    if ($class == 0) {
        $ptgArea = pack("C", $this->ptg[ptgArea]);
    } elseif ($class == 1) {
        $ptgArea = pack("C", $this->ptg[ptgAreaV]);
    } elseif ($class == 2) {
        $ptgArea = pack("C", $this->ptg[ptgAreaA]);
    } else{
        trigger_error("Unknown class", E_USER_ERROR);
    }

    return $ptgArea . $row1 . $row2 . $col1. $col2;
}

###############################################################################
#
# _convert_range3d
#
# Convert an Excel 3d range such as "Sheet1!A1:D4" or "Sheet1:Sheet2!A1:D4" to
# a ptgArea3dV.
#
function _convert_range3d($token, $class) {

    //$ptgArea;

    # Split the ref at the ! symbol
    list($ext_ref, $range) = preg_split('!', $token);

    # Convert the external reference part
    $ext_ref = $this->_pack_ext_ref($ext_ref);

    # Split the range into 2 cell refs
    list($cell1, $cell2) = preg_split(':', $range);

    # Convert the cell references
    list($row1, $col1) = $this->_cell_to_packed_rowcol($cell1);
    list($row2, $col2) = $this->_cell_to_packed_rowcol($cell2);

    # The ptg value depends on the class of the ptg.
    if ($class == 0) {
        $ptgArea = pack("C", $this->ptg[ptgArea3d]);
    } elseif ($class == 1) {
        $ptgArea = pack("C", $this->ptg[ptgArea3dV]);
    } elseif ($class == 2) {
        $ptgArea = pack("C", $this->ptg[ptgArea3dA]);
    } else {
        trigger_error("Unknown class", E_USER_ERROR);
    }

    return $ptgArea . $ext_ref . $row1 . $row2 . $col1. $col2;
}

###############################################################################
#
# _pack_ext_ref()
#
# Convert the sheet name part of an external reference, for example "Sheet1" or
# "Sheet1:Sheet2", to a packed structure.
#
function _pack_ext_ref($ext_ref) {

    //$sheet1;
    //$sheet2;

    $ext_ref = preg_replace("/^'/", '', $ext_ref);   # Remove leading  ' if any.
    $ext_ref = preg_replace("/'$/", '', $ext_ref);   # Remove trailing ' if any.

    # Check if there is a sheet range eg., Sheet1:Sheet2.
    if (preg_match('/:/', $ext_ref)) {
        list($sheet1, $sheet2) = preg_split(':', $ext_ref);

        $sheet1 = $this->_get_sheet_index($sheet1);
        $sheet2 = $this->_get_sheet_index($sheet2);

        # Reverse max and min sheet numbers if necessary
        if ($sheet1 > $sheet2) {
            list($sheet1, $sheet2) = array($sheet2, $sheet1);
        }
    } else {
        # Single sheet name only.
        list($sheet1, $sheet2) = array($ext_ref, $ext_ref);

        $sheet1 = $this->_get_sheet_index($sheet1);
        $sheet2 = $sheet1;
    }

    # References are stored relative to 0xFFFF.
    $offset = -1 - $sheet1;

    return pack("vdvv", $offset, 0x00, $sheet1, $sheet2);
}

###############################################################################
#
# _get_sheet_index()
#
# Look up the index that corresponds to an external sheet name. The hash of
# sheet names is updated by the addworksheet() method of the Workbook class.
#
function _get_sheet_index($sheet_name) {

    if (!isset($this->_ext_sheets->$sheet_name)) {
        trigger_error("Unknown sheet name: $sheet_name", E_USER_ERROR);
    } else {
        return $this->_ext_sheets->$sheet_name;
    }
}

###############################################################################
#
# set_ext_sheets()
#
# This semi-public method is used to update the hash of sheet names. It is
# updated by the addworksheet() method of the Workbook class.
#
function set_ext_sheet($key, $value) {

    $this->_ext_sheets->$key = $value;
}

###############################################################################
#
# _convert_function()
#
# Convert a function to a ptgFunc or ptgFuncVarV depending on the number of
# args that it takes.
#
function _convert_function($token, $num_args) {

    $args     = $this->functions[$token][1];
    $volatile = $this->functions[$token][3];

    if ($volatile) {
        $this->_volatile = 1;
    }

    # Fixed number of args eg. TIME($i,$j,$k).
    if ($args >= 0) {
        # Check that the number of args is valid.
        if ($args != $num_args) {
            trigger_error("Incorrect number of arguments in function $token()",
                          E_USER_ERROR);
        } else {
            return pack("Cv", $this->ptg[ptgFuncV], $this->functions[$token][0]);
        }
    }

    # Variable number of args eg. SUM($i,$j,$k, ..).
    if ($args == -1) {
        return pack("CCv", $this->ptg[ptgFuncVarV], $num_args, $this->functions[$token][0]);
    }
}

###############################################################################
#
# _cell_to_rowcol($cell_ref)
#
# Convert an Excel cell reference such as A1 or $B2 or C$3 or $D$4 to a zero
# indexed row and column number. Also returns two boolean values to indicate
# whether the row or column are relative references.
# TODO use function in Utility.pm
#
function _cell_to_rowcol($cell) {

    preg_match('/(\$?)([A-I]?[A-Z])(\$?)(\d+)/', $cell, $reg);

    $col_rel = ($reg[1]=="") ? 1 : 0;
    $col     = $reg[2];
    $row_rel = ($reg[3]=="") ? 1 : 0;
    $row     = $reg[4];

    # Convert base26 column string to a number.
    # All your Base are belong to us.
    $chars  = preg_split('//', $col, -1, PREG_SPLIT_NO_EMPTY);
    $expn   = 0;
    $col    = 0;

    while (sizeof($chars)>0) {
        $char = array_pop($chars); # LS char first
        $col += (ord($char) - ord('A') + 1) * pow(26, $expn);
        $expn++;
    }

    # Convert 1-index to zero-index
    $row--;
    $col--;

    return array($row, $col, $row_rel, $col_rel);
}

###############################################################################
#
# _cell_to_packed_rowcol($row, $col, $row_rel, $col_rel)
#
# pack() row and column into the required 3 byte format.
#
function _cell_to_packed_rowcol($cell) {

    list($row, $col, $row_rel, $col_rel) = $this->_cell_to_rowcol($cell);

    if ($col >= 256) {
        trigger_error("Column in: $cell greater than 255", E_USER_ERROR);
    }

    if ($row >= 16384) {
        trigger_error("Row in: $cell greater than 16384", E_USER_ERROR);
    }

    # Set the high bits to indicate if row or col are relative.
    $row    |= $col_rel << 14;
    $row    |= $row_rel << 15;

    $row     = pack('v', $row);
    $col     = pack('C', $col);

    return array($row, $col);
}

###############################################################################
#
# _initialize_hashes()
#
function _initialize_hashes() {

    # The Excel ptg indices
    $this->ptg = array(
        'ptgExp'            => 0x01,
        'ptgTbl'            => 0x02,
        'ptgAdd'            => 0x03,
        'ptgSub'            => 0x04,
        'ptgMul'            => 0x05,
        'ptgDiv'            => 0x06,
        'ptgPower'          => 0x07,
        'ptgConcat'         => 0x08,
        'ptgLT'             => 0x09,
        'ptgLE'             => 0x0A,
        'ptgEQ'             => 0x0B,
        'ptgGE'             => 0x0C,
        'ptgGT'             => 0x0D,
        'ptgNE'             => 0x0E,
        'ptgIsect'          => 0x0F,
        'ptgUnion'          => 0x10,
        'ptgRange'          => 0x11,
        'ptgUplus'          => 0x12,
        'ptgUminus'         => 0x13,
        'ptgPercent'        => 0x14,
        'ptgParen'          => 0x15,
        'ptgMissArg'        => 0x16,
        'ptgStr'            => 0x17,
        'ptgAttr'           => 0x19,
        'ptgSheet'          => 0x1A,
        'ptgEndSheet'       => 0x1B,
        'ptgErr'            => 0x1C,
        'ptgBool'           => 0x1D,
        'ptgInt'            => 0x1E,
        'ptgNum'            => 0x1F,
        'ptgArray'          => 0x20,
        'ptgFunc'           => 0x21,
        'ptgFuncVar'        => 0x22,
        'ptgName'           => 0x23,
        'ptgRef'            => 0x24,
        'ptgArea'           => 0x25,
        'ptgMemArea'        => 0x26,
        'ptgMemErr'         => 0x27,
        'ptgMemNoMem'       => 0x28,
        'ptgMemFunc'        => 0x29,
        'ptgRefErr'         => 0x2A,
        'ptgAreaErr'        => 0x2B,
        'ptgRefN'           => 0x2C,
        'ptgAreaN'          => 0x2D,
        'ptgMemAreaN'       => 0x2E,
        'ptgMemNoMemN'      => 0x2F,
        'ptgNameX'          => 0x39,
        'ptgRef3d'          => 0x3A,
        'ptgArea3d'         => 0x3B,
        'ptgRefErr3d'       => 0x3C,
        'ptgAreaErr3d'      => 0x3D,
        'ptgArrayV'         => 0x40,
        'ptgFuncV'          => 0x41,
        'ptgFuncVarV'       => 0x42,
        'ptgNameV'          => 0x43,
        'ptgRefV'           => 0x44,
        'ptgAreaV'          => 0x45,
        'ptgMemAreaV'       => 0x46,
        'ptgMemErrV'        => 0x47,
        'ptgMemNoMemV'      => 0x48,
        'ptgMemFuncV'       => 0x49,
        'ptgRefErrV'        => 0x4A,
        'ptgAreaErrV'       => 0x4B,
        'ptgRefNV'          => 0x4C,
        'ptgAreaNV'         => 0x4D,
        'ptgMemAreaNV'      => 0x4E,
        'ptgMemNoMemN'      => 0x4F,
        'ptgFuncCEV'        => 0x58,
        'ptgNameXV'         => 0x59,
        'ptgRef3dV'         => 0x5A,
        'ptgArea3dV'        => 0x5B,
        'ptgRefErr3dV'      => 0x5C,
        'ptgAreaErr3d'      => 0x5D,
        'ptgArrayA'         => 0x60,
        'ptgFuncA'          => 0x61,
        'ptgFuncVarA'       => 0x62,
        'ptgNameA'          => 0x63,
        'ptgRefA'           => 0x64,
        'ptgAreaA'          => 0x65,
        'ptgMemAreaA'       => 0x66,
        'ptgMemErrA'        => 0x67,
        'ptgMemNoMemA'      => 0x68,
        'ptgMemFuncA'       => 0x69,
        'ptgRefErrA'        => 0x6A,
        'ptgAreaErrA'       => 0x6B,
        'ptgRefNA'          => 0x6C,
        'ptgAreaNA'         => 0x6D,
        'ptgMemAreaNA'      => 0x6E,
        'ptgMemNoMemN'      => 0x6F,
        'ptgFuncCEA'        => 0x78,
        'ptgNameXA'         => 0x79,
        'ptgRef3dA'         => 0x7A,
        'ptgArea3dA'        => 0x7B,
        'ptgRefErr3dA'      => 0x7C,
        'ptgAreaErr3d'      => 0x7D
    );

    # Thanks to Michael Meeks and Gnumeric for the initial arg values.
    #
    # The following hash was generated by "function_locale.pl" in the distro.
    # Refer to function_locale.pl for non-English function names.
    #
    # The array elements are as follow:
    # ptg:   The Excel function ptg code.
    # args:  The number of arguments that the function takes:
    #           >=0 is a fixed number of arguments.
    #           -1  is a variable  number of arguments.
    # class: The reference, value or array class of the function args.
    # vol:   The function is volatile.
    #
    $this->functions = array(
        #                                     ptg  args  class  vol
        'COUNT'                    => array(   0,   -1,    0,    0 ),
        'IF'                       => array(   1,   -1,    1,    0 ),
        'ISNA'                     => array(   2,    1,    1,    0 ),
        'ISERROR'                  => array(   3,    1,    1,    0 ),
        'SUM'                      => array(   4,   -1,    0,    0 ),
        'AVERAGE'                  => array(   5,   -1,    0,    0 ),
        'MIN'                      => array(   6,   -1,    0,    0 ),
        'MAX'                      => array(   7,   -1,    0,    0 ),
        'ROW'                      => array(   8,   -1,    0,    0 ),
        'COLUMN'                   => array(   9,   -1,    0,    0 ),
        'NA'                       => array(  10,    0,    0,    0 ),
        'NPV'                      => array(  11,   -1,    1,    0 ),
        'STDEV'                    => array(  12,   -1,    0,    0 ),
        'DOLLAR'                   => array(  13,   -1,    1,    0 ),
        'FIXED'                    => array(  14,   -1,    1,    0 ),
        'SIN'                      => array(  15,    1,    1,    0 ),
        'COS'                      => array(  16,    1,    1,    0 ),
        'TAN'                      => array(  17,    1,    1,    0 ),
        'ATAN'                     => array(  18,    1,    1,    0 ),
        'PI'                       => array(  19,    0,    1,    0 ),
        'SQRT'                     => array(  20,    1,    1,    0 ),
        'EXP'                      => array(  21,    1,    1,    0 ),
        'LN'                       => array(  22,    1,    1,    0 ),
        'LOG10'                    => array(  23,    1,    1,    0 ),
        'ABS'                      => array(  24,    1,    1,    0 ),
        'INT'                      => array(  25,    1,    1,    0 ),
        'SIGN'                     => array(  26,    1,    1,    0 ),
        'ROUND'                    => array(  27,    2,    1,    0 ),
        'LOOKUP'                   => array(  28,   -1,    0,    0 ),
        'INDEX'                    => array(  29,   -1,    0,    1 ),
        'REPT'                     => array(  30,    2,    1,    0 ),
        'MID'                      => array(  31,    3,    1,    0 ),
        'LEN'                      => array(  32,    1,    1,    0 ),
        'VALUE'                    => array(  33,    1,    1,    0 ),
        'TRUE'                     => array(  34,    0,    1,    0 ),
        'FALSE'                    => array(  35,    0,    1,    0 ),
        'AND'                      => array(  36,   -1,    0,    0 ),
        'OR'                       => array(  37,   -1,    0,    0 ),
        'NOT'                      => array(  38,    1,    1,    0 ),
        'MOD'                      => array(  39,    2,    1,    0 ),
        'DCOUNT'                   => array(  40,    3,    0,    0 ),
        'DSUM'                     => array(  41,    3,    0,    0 ),
        'DAVERAGE'                 => array(  42,    3,    0,    0 ),
        'DMIN'                     => array(  43,    3,    0,    0 ),
        'DMAX'                     => array(  44,    3,    0,    0 ),
        'DSTDEV'                   => array(  45,    3,    0,    0 ),
        'VAR'                      => array(  46,   -1,    0,    0 ),
        'DVAR'                     => array(  47,    3,    0,    0 ),
        'TEXT'                     => array(  48,    2,    1,    0 ),
        'LINEST'                   => array(  49,   -1,    0,    0 ),
        'TREND'                    => array(  50,   -1,    0,    0 ),
        'LOGEST'                   => array(  51,   -1,    0,    0 ),
        'GROWTH'                   => array(  52,   -1,    0,    0 ),
        'PV'                       => array(  56,   -1,    1,    0 ),
        'FV'                       => array(  57,   -1,    1,    0 ),
        'NPER'                     => array(  58,   -1,    1,    0 ),
        'PMT'                      => array(  59,   -1,    1,    0 ),
        'RATE'                     => array(  60,   -1,    1,    0 ),
        'MIRR'                     => array(  61,    3,    0,    0 ),
        'IRR'                      => array(  62,   -1,    0,    0 ),
        'RAND'                     => array(  63,    0,    1,    1 ),
        'MATCH'                    => array(  64,   -1,    0,    0 ),
        'DATE'                     => array(  65,    3,    1,    0 ),
        'TIME'                     => array(  66,    3,    1,    0 ),
        'DAY'                      => array(  67,    1,    1,    0 ),
        'MONTH'                    => array(  68,    1,    1,    0 ),
        'YEAR'                     => array(  69,    1,    1,    0 ),
        'WEEKDAY'                  => array(  70,   -1,    1,    0 ),
        'HOUR'                     => array(  71,    1,    1,    0 ),
        'MINUTE'                   => array(  72,    1,    1,    0 ),
        'SECOND'                   => array(  73,    1,    1,    0 ),
        'NOW'                      => array(  74,    0,    1,    1 ),
        'AREAS'                    => array(  75,    1,    0,    1 ),
        'ROWS'                     => array(  76,    1,    0,    1 ),
        'COLUMNS'                  => array(  77,    1,    0,    1 ),
        'OFFSET'                   => array(  78,   -1,    0,    1 ),
        'SEARCH'                   => array(  82,   -1,    1,    0 ),
        'TRANSPOSE'                => array(  83,    1,    1,    0 ),
        'TYPE'                     => array(  86,    1,    1,    0 ),
        'ATAN2'                    => array(  97,    2,    1,    0 ),
        'ASIN'                     => array(  98,    1,    1,    0 ),
        'ACOS'                     => array(  99,    1,    1,    0 ),
        'CHOOSE'                   => array( 100,   -1,    1,    0 ),
        'HLOOKUP'                  => array( 101,   -1,    0,    0 ),
        'VLOOKUP'                  => array( 102,   -1,    0,    0 ),
        'ISREF'                    => array( 105,    1,    0,    0 ),
        'LOG'                      => array( 109,   -1,    1,    0 ),
        'CHAR'                     => array( 111,    1,    1,    0 ),
        'LOWER'                    => array( 112,    1,    1,    0 ),
        'UPPER'                    => array( 113,    1,    1,    0 ),
        'PROPER'                   => array( 114,    1,    1,    0 ),
        'LEFT'                     => array( 115,   -1,    1,    0 ),
        'RIGHT'                    => array( 116,   -1,    1,    0 ),
        'EXACT'                    => array( 117,    2,    1,    0 ),
        'TRIM'                     => array( 118,    1,    1,    0 ),
        'REPLACE'                  => array( 119,    4,    1,    0 ),
        'SUBSTITUTE'               => array( 120,   -1,    1,    0 ),
        'CODE'                     => array( 121,    1,    1,    0 ),
        'FIND'                     => array( 124,   -1,    1,    0 ),
        'CELL'                     => array( 125,   -1,    0,    1 ),
        'ISERR'                    => array( 126,    1,    1,    0 ),
        'ISTEXT'                   => array( 127,    1,    1,    0 ),
        'ISNUMBER'                 => array( 128,    1,    1,    0 ),
        'ISBLANK'                  => array( 129,    1,    1,    0 ),
        'T'                        => array( 130,    1,    0,    0 ),
        'N'                        => array( 131,    1,    0,    0 ),
        'DATEVALUE'                => array( 140,    1,    1,    0 ),
        'TIMEVALUE'                => array( 141,    1,    1,    0 ),
        'SLN'                      => array( 142,    3,    1,    0 ),
        'SYD'                      => array( 143,    4,    1,    0 ),
        'DDB'                      => array( 144,   -1,    1,    0 ),
        'INDIRECT'                 => array( 148,   -1,    1,    1 ),
        'CALL'                     => array( 150,   -1,    1,    0 ),
        'CLEAN'                    => array( 162,    1,    1,    0 ),
        'MDETERM'                  => array( 163,    1,    2,    0 ),
        'MINVERSE'                 => array( 164,    1,    2,    0 ),
        'MMULT'                    => array( 165,    2,    2,    0 ),
        'IPMT'                     => array( 167,   -1,    1,    0 ),
        'PPMT'                     => array( 168,   -1,    1,    0 ),
        'COUNTA'                   => array( 169,   -1,    0,    0 ),
        'PRODUCT'                  => array( 183,   -1,    0,    0 ),
        'FACT'                     => array( 184,    1,    1,    0 ),
        'DPRODUCT'                 => array( 189,    3,    0,    0 ),
        'ISNONTEXT'                => array( 190,    1,    1,    0 ),
        'STDEVP'                   => array( 193,   -1,    0,    0 ),
        'VARP'                     => array( 194,   -1,    0,    0 ),
        'DSTDEVP'                  => array( 195,    3,    0,    0 ),
        'DVARP'                    => array( 196,    3,    0,    0 ),
        'TRUNC'                    => array( 197,   -1,    1,    0 ),
        'ISLOGICAL'                => array( 198,    1,    1,    0 ),
        'DCOUNTA'                  => array( 199,    3,    0,    0 ),
        'ROUNDUP'                  => array( 212,    2,    1,    0 ),
        'ROUNDDOWN'                => array( 213,    2,    1,    0 ),
        'RANK'                     => array( 216,   -1,    0,    0 ),
        'ADDRESS'                  => array( 219,   -1,    1,    0 ),
        'DAYS360'                  => array( 220,   -1,    1,    0 ),
        'TODAY'                    => array( 221,    0,    1,    1 ),
        'VDB'                      => array( 222,   -1,    1,    0 ),
        'MEDIAN'                   => array( 227,   -1,    0,    0 ),
        'SUMPRODUCT'               => array( 228,   -1,    2,    0 ),
        'SINH'                     => array( 229,    1,    1,    0 ),
        'COSH'                     => array( 230,    1,    1,    0 ),
        'TANH'                     => array( 231,    1,    1,    0 ),
        'ASINH'                    => array( 232,    1,    1,    0 ),
        'ACOSH'                    => array( 233,    1,    1,    0 ),
        'ATANH'                    => array( 234,    1,    1,    0 ),
        'DGET'                     => array( 235,    3,    0,    0 ),
        'INFO'                     => array( 244,    1,    1,    1 ),
        'DB'                       => array( 247,   -1,    1,    0 ),
        'FREQUENCY'                => array( 252,    2,    0,    0 ),
        'ERROR.TYPE'               => array( 261,    1,    1,    0 ),
        'REGISTER.ID'              => array( 267,   -1,    1,    0 ),
        'AVEDEV'                   => array( 269,   -1,    0,    0 ),
        'BETADIST'                 => array( 270,   -1,    1,    0 ),
        'GAMMALN'                  => array( 271,    1,    1,    0 ),
        'BETAINV'                  => array( 272,   -1,    1,    0 ),
        'BINOMDIST'                => array( 273,    4,    1,    0 ),
        'CHIDIST'                  => array( 274,    2,    1,    0 ),
        'CHIINV'                   => array( 275,    2,    1,    0 ),
        'COMBIN'                   => array( 276,    2,    1,    0 ),
        'CONFIDENCE'               => array( 277,    3,    1,    0 ),
        'CRITBINOM'                => array( 278,    3,    1,    0 ),
        'EVEN'                     => array( 279,    1,    1,    0 ),
        'EXPONDIST'                => array( 280,    3,    1,    0 ),
        'FDIST'                    => array( 281,    3,    1,    0 ),
        'FINV'                     => array( 282,    3,    1,    0 ),
        'FISHER'                   => array( 283,    1,    1,    0 ),
        'FISHERINV'                => array( 284,    1,    1,    0 ),
        'FLOOR'                    => array( 285,    2,    1,    0 ),
        'GAMMADIST'                => array( 286,    4,    1,    0 ),
        'GAMMAINV'                 => array( 287,    3,    1,    0 ),
        'CEILING'                  => array( 288,    2,    1,    0 ),
        'HYPGEOMDIST'              => array( 289,    4,    1,    0 ),
        'LOGNORMDIST'              => array( 290,    3,    1,    0 ),
        'LOGINV'                   => array( 291,    3,    1,    0 ),
        'NEGBINOMDIST'             => array( 292,    3,    1,    0 ),
        'NORMDIST'                 => array( 293,    4,    1,    0 ),
        'NORMSDIST'                => array( 294,    1,    1,    0 ),
        'NORMINV'                  => array( 295,    3,    1,    0 ),
        'NORMSINV'                 => array( 296,    1,    1,    0 ),
        'STANDARDIZE'              => array( 297,    3,    1,    0 ),
        'ODD'                      => array( 298,    1,    1,    0 ),
        'PERMUT'                   => array( 299,    2,    1,    0 ),
        'POISSON'                  => array( 300,    3,    1,    0 ),
        'TDIST'                    => array( 301,    3,    1,    0 ),
        'WEIBULL'                  => array( 302,    4,    1,    0 ),
        'SUMXMY2'                  => array( 303,    2,    2,    0 ),
        'SUMX2MY2'                 => array( 304,    2,    2,    0 ),
        'SUMX2PY2'                 => array( 305,    2,    2,    0 ),
        'CHITEST'                  => array( 306,    2,    2,    0 ),
        'CORREL'                   => array( 307,    2,    2,    0 ),
        'COVAR'                    => array( 308,    2,    2,    0 ),
        'FORECAST'                 => array( 309,    3,    2,    0 ),
        'FTEST'                    => array( 310,    2,    2,    0 ),
        'INTERCEPT'                => array( 311,    2,    2,    0 ),
        'PEARSON'                  => array( 312,    2,    2,    0 ),
        'RSQ'                      => array( 313,    2,    2,    0 ),
        'STEYX'                    => array( 314,    2,    2,    0 ),
        'SLOPE'                    => array( 315,    2,    2,    0 ),
        'TTEST'                    => array( 316,    4,    2,    0 ),
        'PROB'                     => array( 317,   -1,    2,    0 ),
        'DEVSQ'                    => array( 318,   -1,    0,    0 ),
        'GEOMEAN'                  => array( 319,   -1,    0,    0 ),
        'HARMEAN'                  => array( 320,   -1,    0,    0 ),
        'SUMSQ'                    => array( 321,   -1,    0,    0 ),
        'KURT'                     => array( 322,   -1,    0,    0 ),
        'SKEW'                     => array( 323,   -1,    0,    0 ),
        'ZTEST'                    => array( 324,   -1,    0,    0 ),
        'LARGE'                    => array( 325,    2,    0,    0 ),
        'SMALL'                    => array( 326,    2,    0,    0 ),
        'QUARTILE'                 => array( 327,    2,    0,    0 ),
        'PERCENTILE'               => array( 328,    2,    0,    0 ),
        'PERCENTRANK'              => array( 329,   -1,    0,    0 ),
        'MODE'                     => array( 330,   -1,    2,    0 ),
        'TRIMMEAN'                 => array( 331,    2,    0,    0 ),
        'TINV'                     => array( 332,    2,    1,    0 ),
        'CONCATENATE'              => array( 336,   -1,    1,    0 ),
        'POWER'                    => array( 337,    2,    1,    0 ),
        'RADIANS'                  => array( 342,    1,    1,    0 ),
        'DEGREES'                  => array( 343,    1,    1,    0 ),
        'SUBTOTAL'                 => array( 344,   -1,    0,    0 ),
        'SUMIF'                    => array( 345,   -1,    0,    0 ),
        'COUNTIF'                  => array( 346,    2,    0,    0 ),
        'COUNTBLANK'               => array( 347,    1,    0,    0 ),
        'ROMAN'                    => array( 354,   -1,    1,    0 )
    );

}

}

?>
