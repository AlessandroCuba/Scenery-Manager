<?php
    if(count($portafolioList)){
        foreach ($portafolioList as $portafolioListe) { ?>
            <div class="col-md-4 img-portfolio">
                <a href="portfolio-item.html">
                    <img class="img-responsive img-hover" src="http://placehold.it/700x400" alt="">
    		</a>
    		<h4>
                    <a href="portfolio-item.html"><?= $portafolioListe -> icao ?></a>
    		</h4>
                <p><?= $portafolioListe->description ?></p>
                <p><?= $portafolioListe->catesim ?></p>
            </div>
        <?php } 
    }
?>