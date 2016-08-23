<?php 
    require("header.php");  
?>
<div class="row">
    <div id="movie" data-template>
        <li class="col-xs-6 col-sm-3 listStyleNone top_10_main">
            <a href="/moviePlay.php?id={{id}}&name={{name}}&resource={{resource}}">
            <img src="resource/movie/{{image}}" class="img-responsive" /></a>
            <br>
            {{name}}
        </li>
        <li data-template-fallback>no resource</li>
    </div>
    <script>
        Tempo.prepare("movie").render(movie.movie);
    </script>    
</div>
<?php 
    require("footer.php");
?>
