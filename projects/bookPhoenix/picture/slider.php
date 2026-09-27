

<div class="gallery-slider">
    <?php 
    $totalImages = 25;

    $captions = [
        1 => "Jeg k&oslash;rte galt igen i 2018",
        2 => "Jeg viser min nye baryton saxofon frem for familien",
        3 => "I gymnasiet glattede vi mit h&aring;r",
        4 => "Da jeg er omkring 18 &aring;r",
	5 => "Sommerferie i gymnasiet",
	6 => "Da jeg flytter fra Aarhus",
	7 => "Jeg fik en gravko i f&oslash;dselsdagsgave",
	8 => "I min bedste alder",
	9 => "P&aring; sygehuset efter ulykken",
	10 => "P&aring; sygehuset efter ulykken",
	11 => "F&oslash;rste skoledag",
	12 => "Kl&aelig;dt ud som Harry Potter",
	13 => "Koncert med saxofon kvartet i Aarhus",
	14 => "Min situation efter ulykken",
	15 => "Hvordan jeg havde det, da jeg var ved at vende rundt",
	16 => "Dagen min bog udkommer",	
	17 => "Fejring af min 30 &aring;rs f&oslash;dselsdag",	
	18 => "F&oslash;rste gang mit ar kom frem",
	19 => "Jeg hj&aelig;lper Kasper med at flytte",
	20 => "Stiveste puds i milit&aelig;ret",
	21 => "P&aring; felttur",
	22 => "Da vi er f&aelig;rdige med 2. felttur",
	23 => "Bilen der k&oslash;rte ind i hos",
	24 => "Den bil jeg sad i",
	25 => "G&aring;tur p&aring; h&aelig;rvejen med Kristian",
    ];

    // Each image gets a 3-second window
    for ($i = 1; $i <= $totalImages; $i++): 
        $delay = ($i - 1) * 5;
	$rand = random_int(1, 26);	
	$text = $captions[$i] ?? "";
    ?>
	<div class="slide" style="animation-delay:
	  <?php echo $delay; ?>s; animation-duration:
	    <?php echo $total_duration; ?>s;
	  ">
            <div class="slide-content">
                
                <div class="image-box">
                    <img src="../projects/picture/images/1 (<?php echo $i; ?>).jpg">
                </div>

                <div class="text-box">
                    <p class="caption-text"><?php echo $text; ?></p>
                </div>

            </div>
        </div>
    <?php endfor; ?>
</div>


<style>

.gallery-slider .slide {
    position: absolute;
    top: 0;
    left: 0;
    width: 100%;
    height: 100%;
    opacity: 0;
    /* Total cycle = total_images * 3s */
    animation: fade 130s infinite; 
}

.gallery-slider {
    position: relative;
    width: 700px;
    height: 600px;
    margin: 40px auto;
    overflow: hidden;
    border: 1px solid #d1ccc0;
}

.slide img {
    width: 100%;
    height: 100%;
    object-fit: cover;
    filter: sepia(10%);
}

@keyframes fade {
    0% { opacity: 0; }
    /* Each image shows for 3s out of the 78s cycle */
    /* (3/130) * 100 = ~3.8% */
    3.8% { opacity: 1; }
    7.6% { opacity: 0; }
    100% { opacity: 0; }
}


</style>





