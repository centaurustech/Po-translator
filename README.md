# .Po Translator con PHP

Usando la teoría funcional del trabajo realizado por Julio Sánchez en HelpTranslator (LINUX)
https://jsbsan.blogspot.com/2015/02/helptranslator-herramienta-para-ayudar.html,

_Nace este script traductor semi-automático para archivos .PO capaz de ayudar en el proceso de traducción de estos archivos, con PHP._


## BETA 🚀

A futuro, pienso agregarle una interfaz para que cualquier usuario pueda utilizarla sin tener que tocar lineas de codigo, pero, por ahora, es necesario ensuciarse los dedos.

En principio cuenta con dos scripts. El primero **[extraer.php]**, encargado de extraer las frases a ser traducidas del archivo .po a un archivo de texto linea por linea [file_name]_detached.txt, dicho archivo deberá ser traducido con Google, a la par, genera un archivo [file_name]_opt.po (una versión optimizada para poder extraer frases multilineas). El resultado de la traducción de Google deberá ser grabado en otro archivo con nombre [file_name]_traducido.txt para luego ser procesado y combinado con el script **[combinar.php]**. En el proceso combinatorio se utiliza el archivo [file_name]_opt.po y el [file_name]_traducido.txt generando el archivo [file_name]_combinado.po, dicho archivo deberá ser abierto y guardado con PoEdit para la generación del archivo ([file_name].mo).

P.D.: Previa edición del archivo .po con PoEdit, es necesario reemplazar "\\\\" por "\\" del archivo resultante [file_name]_combinado.po. Por falta de tiempo aún no llegué a corregir ese detalle.

_(Archivo .po original)_

**[file_name].po**
```
..
msgid "Hello World"
msgstr ""

msgid "Good Morning"
msgstr ""
..
```
_(archivo generado por el script con lineas extraidas del archivo [file\_name].po para ser traducidas en Google Translate® u otro traductor)_

**[file_name]_detached.txt**
```
Hello World
Good Morning
```

_(lineas copiadas desde Google Translate® u otro traductor)_

**[file_name]_traducido.txt**
```
Hola Mundo
Buenos dias
```

_(Archivo resultante de la combinacion de [file\_name].po y [file_name]\_traducido.txt listo para ser verificado con PoEdit®)_

**[file_name]_combinado.po**


### Pre-requisitos 📋

```
- Tener algún servidor web con PHP >=5 corriendo
- Un archivo .po en la misma carpeta del script
```
### Modo de uso 📋

```
1- Run al Apache (u otro server que estes corriendo)
2- Colocar el archivo [file_name].po en la carpeta donde se encuentra extraer.php
3- Acceder al link http://localhost/<carpeta_clonada>/extraer.php
3.1- Esto genera 2 archivos. <file_name>_opt.po y <file_name_detached>.txt
4- Copiar el archivo <file_name_detached>.txt a un hosting para ser accesible en internet, ejemplo http://<dominio>/file_name_detached.txt
5- Ingresar a https://translate.google.com/ y pegar el link. Generalmente lado izquierdo texto o página origen, lado derecho, texto o página traducida
6- Copiar texto traducido a un archivo <file_name>_traduccion.txt ¡¡Este paso es importante!!. El archivo debe tener la misma cantidad de líneas que el archivo detached. Eliminar la primera linea en blanco del archivo <file_name>_traduccion.txt si lo tuviere, a veces, al copiar de la página de Google, viene una linea en blanco.
7- Acceder al link http://localhost/<carpeta_clonada>/combinar.php, lo que hace es combinar los archivos <file_name>_opt.po y <file_name>_traduccion.txt y genera <file_name>_combinado.po
8- Renombrar <file_name>_combinado.po a <file_name>.po
9- Abrir archivo <file_name>.po con un editor de texto, reemplazando las \\ por \, luego (guardar y cerrar).
10- Abrir archivo <file_name>.po con PoEdit para afinar detalles. (Al guardar genera el archivo <file_name>.mo)
11- Subir los archivos <file_name>.po y <file_name>.mo al destino correspondiente. Ejemplo https://<dominio>/wp-content/plugins/<nombre_plugin>/languagues/
```

## Construido con 🛠️

* [PHP] >= 5

## Autores ✒️

* **Ronald Caetano** - *Adaptación a PHP* - [centaurustech](https://github.com/centaurustech)

## Licencia 📄

Oimene nde roga lao ojeipuru la licencia che kavaju. (Libre como el viento)

## Expresiones de Gratitud 🎁

* Comenta a otros sobre este proyecto 📢
* Invita una cerveza 🍺 o un café ☕ a alguien del equipo (https://buymeacoffee.com/commit.latam). 
* Agradezco a Julio Sánchez por HelpTranslator, sin ello, estos scripts tardarían mucho tiempo en ver la luz🤓.

---
Con ❤️ por [Ronald Caetano](https://github.com/centaurustech) 😊
