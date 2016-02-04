Test - symfony
========================

Crear un end point donde el usuario pueda hacer login con un email y una contraseña, y pueda crear su usuario desde otra sección así como hacer el forgot password y que por swift mailer le envie una nueva clave al usuario. Haciendo uso del secure area. Puedes usar fos user bundle si quieres. Usando doctrine y el orm de mysql de momento.

Por otro lado, una vez que se ha creado el acceso al panel, mostrar una pantalla con una tabla listado donde se puedan añadir tokens y sus traducciones al inglés y castellano. Es decir, una lista con posibilidad de editar los elementos y añadir nuevos a la tabla.

Si eres capaz de hacer que los idiomas sean infinitos mejor, que la solución no esté cohesionada a dos idiomas o tres nada más. Algo más versátil.

Por último realizar una api sencilla usando fos rest full api para mostrar el listado de tokens, o mostrar algún token particular en el idioma deseado.


1) Api Token
----------------------------------

a) /api/all-translates.json

b) /api/translate.json?language=Español
c) /api/translate.json?token=_hola&language=Español
