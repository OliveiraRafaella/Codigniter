<h2>{titulo}</h2>
<hr>

{#comentario do parser#}

<ul> {#nova maneira de fazer foreach#}
    {nomes}
        <li>{nome}</li>
    {/nomes}
</ul>

<hr>
<p>É utilizador de admin?</p>

{if($admin)}
    <p>Sim</p>
{else}
    <p>Não</p>
{endif}

{noparse} <!--tira o parser do bloco-->
{/noparse}