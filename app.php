<?php 
    require("header.php");  
?>
<div class="row">
    <div id="app" data-template>
        <li class="col-xs-6 col-sm-3 listStyleNone top_10_main">
            <a href="/appPlay.php?id={{id}}&name={{name}}&resource={{resource}}">
            <img src="resource/app/{{image}}" class="img-responsive" /></a>
            <br>
            {{name}}
        </li>
        <li data-template-fallback>no resource</li>
    </div>
    <script>
        Tempo.prepare("app").render(app.app);
    </script>    
</div>
<?php 
    require("footer.php");
?>
