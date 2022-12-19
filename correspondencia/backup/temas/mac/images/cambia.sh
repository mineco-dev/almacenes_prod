#! /bin/sh
origen=png
destino=gif
   #comando=`ls $i`   
   #mandado=`gimp -c -i -d -b '(script-fu-png2gif 64 $i "plan.gif")' '(gimp-quit 0)'`   
   #echo $comando
   #echo $mandado
#!/bin/bash

for file in *.png; do
	echo "Trasformando de .png a gif el archivo $file..."
	#mv $file $file.html
	
	mandado="`gimp -c -i -d -b '(script-fu-png2gif 64 "'$file'" "'$file.gif'")' '(gimp-quit 0)'`"
	echo $mandado
	sleep 1
done
