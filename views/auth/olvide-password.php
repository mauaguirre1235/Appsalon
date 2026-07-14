<h1 class="nombre-pagina">Olvidaste tu password</h1>
<p class="descripcion">Restablecer tu password escribiendo tu email a continuacion</p>

<form class="formulario" method="POST" action="/olvide">
     <div class="campo">
        <label for="email">Email</label>
        <input 
        type="email"
        id="email"
        name="email" 
        placeholder="Tu email"/>
    </div>
    <input type="submit" value="Enviar Instrucciones" class="boton">
</form> 

<div class="acciones">
    <a href="/">¿ Ya tienes una cuenta ? Iniciar sesion</a>
    <a href="/crear-cuenta">¿Aun no tienes una cuenta? cREAR UNA</a>
</div>