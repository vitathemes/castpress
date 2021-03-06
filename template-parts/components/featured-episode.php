<?php 
/**
 * 
 * 
 *  Featured episode 
 * 
 * 
 * 
 * 
 */


?>

<div class="c-episode__featured">
    <div class="c-episode__head">
        <div class="c-episode__image">

            <img src="<?php echo get_stylesheet_directory_uri(). '/assets/images/featured_image.jpg'  ?>" />

        </div>

        <div class="c-episode__context">
            <div class="c-episode__category">
                <h5 class="h5-lh--sm">Education</h5>
            </div>

            <div class="c-episode__title">
                <h2>Makemeup Podcast Theme; launch an audio podcast website</h2>
            </div>

            <div class="c-episode__meta">
                <span class="h5 h5-lh--sm">Episode 18</span>
                <span class="h5 h5-lh--sm">|</span>
                <span class="h5 h5-lh--sm">Januray 8, 2021</span>
                <span class="h5 h5-lh--sm">|</span>
                <span class="h5 h5-lh--sm">By VitaThemes</span>
            </div>
        </div>
    </div>

    <div class="c-episode__palyer">
        <template>

            <div id="audio-player-container">
                <audio src="" preload="metadata" loop></audio>
                <p>audio player ish</p>
                <button id="play-icon"></button>
                <span id="current-time" class="time">0:00</span>
                <input type="range" id="seek-slider" max="100" value="0">
                <span id="duration" class="time">0:00</span>
                <output id="volume-output">100</output>
                <input type="range" id="volume-slider" max="100" value="100">
                <button id="mute-icon"></button>
            </div>
        </template>

        <audio-player data-src="https://assets.codepen.io/4358584/Anitek_-_Komorebi.mp3"></audio-player>

    </div>
</div>