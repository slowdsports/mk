<style>
    body {
        background: #000;
        margin: 0;
        padding: 0;
    }
    .container {
        width: 100%!important;
        height: 100vh!important;
    }
    #player {
        height: 100%!important;
        width: 100%!important;
    }
</style>
<script src="https://ssl.p.jwpcdn.com/player/v/8.24.0/jwplayer.js"></script>
<?php
echo '
<script>
var source = "' . $_GET['r'] . '";
var key = "' . $_GET['key'] . '";
var key2 = "' . $_GET['key2'] . '";
var img = "' . $_GET['img'] . '";
</script>'; ?>
<div class="container">
    <div id="player"></div>
</div>
<script>
    jwplayer.key = 'XSuP4qMl+9tK17QNb+4+th2Pm9AWgMO/cYH8CI0HGGr7bdjo';
    var playerInstance = jwplayer("player");

    playerInstance.setup({
        playlist: [{
            image: atob(img),
            sources: [{
                default: false,
                type: "dash",
                file: atob(source),
                drm: {
                    clearkey: {
                        keyId: atob(key),
                        key: atob(key2)
                    },
                },
                label: "0",
            }, ],
        }, ],
        //height: "50%",
        width: "100%",
        aspectratio: "16:9",
        stretching: "bestfit",
        mediaid: "player",
        mute: true,
        autostart: false,
        language: "es",
        cast: {
            appid: "player",
            logo: "https://eduveel1.github.io/baleada/img/iRTVW_PLAYER.png",
        },
        logo: {
            file: "https://eduveel1.github.io/baleada/img/iRTVW_PLAYER.png",
            hide: "false",
            position: "top-left",
        }
    });
    // Preview Hack
    setTimeout(function() {
        jwplayer().setMute(false);
        jwplayer().setControls(true);
    }, 1000);
    jwplayer().onTime(function(object) {
        if (object.position > object.duration - 1) {
            jwplayer().pause();
        }
    });

    function goFullscreen(id) {
        // Get the element that we want to take into fullscreen mode
        var element = document.getElementById("jwp");
        // These function will not exist in the browsers that don't support fullscreen mode yet,
        // so we'll have to check to see if they're available before calling them.
        if (element.mozRequestFullScreen) {
            // This is how to go into fullscren mode in Firefox
            // Note the "moz" prefix, which is short for Mozilla.
            element.mozRequestFullScreen();
        } else if (element.webkitRequestFullScreen) {
            // This is how to go into fullscreen mode in Chrome and Safari
            // Both of those browsers are based on the Webkit project, hence the same prefix.
            element.webkitRequestFullScreen();
        }
        // Hooray, now we're in fullscreen mode!
    }
</script>