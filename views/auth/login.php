<h1 class="nombre-pagina">Login</h1>
<p class="descripcion-pagina">Iniciar sesion con tus datos</p>

<form action="formulario" method="POST" action="/">
    <div class="campo">
        <label for="email">Email</label>
        <input 
            type="email"
            id="email"
            placeholder="Tu emmail" 
            name="email"/>
    </div>

    <div class="campo">
        <label for="password">Password</label>
        <input 
            type="password" 
            id="password"
            placeholder="Tu password"
            name="password"/>
    </div>

    <input type="submit" class="boton" value="Iniciar Sesion">
</form>

<div class="acciones">
    <a href="/crear-cuenta">Aun no tienes una cuenta ?</a>
    <a href="/olvide">Olvidaste tu password</a>
</div>