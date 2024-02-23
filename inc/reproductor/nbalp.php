<html lang="es">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta http-equiv="cache-control" content="max-age=0" />
    <meta http-equiv="cache-control" content="no-cache" />
    <meta http-equiv="expires" content="0" />
    <meta http-equiv="expires" content="Tue, 01 Jan 1980 1:00:00 GMT" />
    <meta http-equiv="pragma" content="no-cache" />
    <meta name="robots" content="noindex" />
    <meta name="referrer" content="none">
    <script src="//cdn.bitmovin.com/player/web/8/bitmovinplayer.js"></script>
    <script disable-devtool-auto src="//fastly.jsdelivr.net/npm/disable-devtool@latest/disable-devtool.min.js"></script>
    <script type="text/javascript">
        // function getParameterByName(name) {
        //     name = name.replace(/[\[]/, "\\[").replace(/[\]]/, "\\]");
        //     var regex = new RegExp("[\\?&]" + name + "=([^&#]*)"),
        //         results = regex.exec(location.search);
        //     return results === null ? "" : decodeURIComponent(results[1].replace(/\+/g, " "));
        // }
        // var getHLS = getParameterByName('img');
        // var getDATA = getParameterByName('id');
        // if (getURL == "#") { alert('Vuelve a la pÃƒÂ¨Ã‚Â°Ã‚Â©gina anterior'); }
        // if (getURL.length > 10) {
        //     var container = document.getElementById('bitmovin-94527');
        // }
    </script>
    <style>
        body {
            margin: 0;
        }

        iframe {
            width: 100%;
            height: 100%;
        }

        .bmpui-ui-watermark {
            display: none;
        }

        .bmpui-ui-volumeslider .bmpui-seekbar .bmpui-seekbar-playbackposition-marker {
            background-color: #1487fa;
        }

        .bmpui-ui-seekbar .bmpui-seekbar .bmpui-seekbar-playbackposition,
        .bmpui-ui-volumeslider .bmpui-seekbar .bmpui-seekbar-playbackposition {
            background-color: #1487fa;
        }

        .bmpui-ui-seekbar .bmpui-seekbar .bmpui-seekbar-playbackposition-marker,
        .bmpui-ui-volumeslider .bmpui-seekbar .bmpui-seekbar-playbackposition-marker {
            border-color: #1487fa;
            background-color: #1487fa;
        }
    </style>
</head>

<body>
    <div id="player"></div>
    <script type="text/javascript">
        var container = document.getElementById('player');

        function override(url) {
            if (url.indexOf("licensing.bitmovin.com/licensing") > -1) return "data:text/plain;charset=utf-8;base64,eyJzdGF0dXMiOiJncmFudGVkIiwibWVzc2FnZSI6IlRoZXJlIHlvdSBnby4ifQ==";
            if (url.indexOf("licensing.bitmovin.com/impression") > -1) return "data:text/plain;charset=utf-8;base64,eyJzdGF0dXMiOiJncmFudGVkIiwibWVzc2FnZSI6IlRoZXJlIHlvdSBnby4ifQ==";
            return url;
        }

        var opens = XMLHttpRequest.prototype.open;
        XMLHttpRequest.prototype.open = function () {
            var url = override(arguments[1]);
            arguments[1] = url;
            return opens.apply(this, arguments);
        }

        const config = {
            key: "11d3698c-efdf-42f1-8769-54663995de2b",
            analytics: false,
            cast: {
                enable: true
            },
            playback: {
                autoplay: false,
                muted: false
            },
            style: {
                width: '100%'
            },
        }

        var source = {
            hls: 'https://nbalpng.akamaized.net/live/a/hls-wvpr/<?= $_GET['img'] ?>/index.m3u8?addUserInfo=1',
            poster: '',
            drm: {
                widevine: {
                    LA_URL: 'https://ottapp-appgw-amp.nba.com/v1/client/get-widevine-license?ownerUid=azuki&mediaId=<?= $_GET['img'] ?>&sessionId=5e0b8a97-3d2e-4188-9590-f00f5f8629a2&is_dvr=false',
                    headers: {
                        'applicationtoken': <?= $_GET['id'] ?>,
                        'authorizationtoken': 'AuthToken1jVHbbtQwEP2azZtX8fgS-yEPoZR2BQWJtqLqm2NPuukmcbCdtuHrcW8gIUCVrPHozJkzozPN4nqcLNb7lOa4Yc0GPuQXcFj76WY2Ia3bOXhntlNrtumO2cEvbmv9mFnFLsYFwx-9McX_tDxyf1PtHkcTtw_jEL2Ztz7cZPQ-5gBlKfL3FHqHU-rTmlM7mH58rE9mxBoXUlIulTRInGgd4bRCYhSnpNWSG4sKKieKC5zMlHaudtiZZUjFe7zrLWZA2rskdMuJndVADodhIV52e8LoLSJqe9A4v7Av1hnrnY8Xph0wFc0w-Ht0r9Lxl_ZlxJCV37pbY61fnpZTFpQWGgjvbEl4yyxpgXVEKesqtK0xrMu7PE15GfKmlr9aPvY2-Oi79HKYV9PVo-nyH6YHP2Adlzba0LcYimZJex_6Hyb1fjoz8VBToSlnnAkpKGW0AsGVrgAY1byUWoGUSjGgXGipQAgqKEgtVKmVFCVQYBoYLynLuaiAgxJU5kQVxw9zHzB-mWpalUJSlZWKo4AmoXsGIY-ADH7E9WTp87Gt67LLLdG0FIQ7XhHTgSQdo1SXVDABbXF61hydnzYgZA33X5dvbD25utx9f-fPP8Vorm9vpmU9gvGYb6C7ZrzBw0m4cp93G-Z-Ag',
                        'azukiimc': 'IMC7.1.0_AN_D3.0.0_S0',
                        'deviceprofile': 'eyJtb2RlbCI6IkRlc2t0b3AiLCJvc1ZlcnNpb24iOiIxMCIsInZlbmRvck5hbWUiOiJNaWNyb3NvZnQiLCJvc05hbWUiOiJIVE1MNSIsInd2TGV2ZWwiOiJMMyIsImRldmljZVVVSUQiOiJmMGRiYjMwYTIwMmM0MGQyYjY3MzBlM2U2NTM2YmE2OSJ9',
                    }
                }
            }
        }
        var player = new bitmovin.player.Player(container, config);
        player.load(source);
    </script>
</body>