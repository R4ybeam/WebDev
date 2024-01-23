document.addEventListener('DOMContentLoaded', function() {
    var map = L.map('map').setView([51.05, 3.7167], 13); // Ghent, Belgium coordinates
    L.tileLayer('https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png').addTo(map); // Add the OpenStreetMap layer
    var heatData = [
        [51.05669007064068, 3.740233903413773, 3], // Gent Dampoort 1
        [51.055827031108414, 3.74016820788928, 5], // gent Dampoort 2
        [51.05552729336302, 3.740283037166038, 3.5], // gent Dampoort 3
        [51.0552315635861, 3.7404138149535444, 3], // gent Dampoort 4
        [51.03462547890297, 3.7102416432188208, 5.5], // Gent-Sint-Pieters Station achter 1
        [51.03472771458496, 3.709572547794209, 5.5], // Gent-Sint-Pieters Station achter 2
        [51.03445101186288, 3.7093297819734947, 5], // Gent-Sint-Pieters Station achter 3
        [51.036868278112934, 3.7107530451699517, 5.5], // Gent-Sint-Pieters Station voor 1
        [51.03667768885354, 3.711705229265484, 5.5], // Gent-Sint-Pieters Station voor 2
        [51.03586321779966, 3.711914419108867, 4], // Fietsenparking sint pieters donkey republik
        [51.036424615602705, 3.7089500189607785, 5], // Ondergrondse fietsenparking sint pieters
        [51.04798928439448, 3.7309862311192306, 2.5], // Gent zuid 1
        [51.04822542292832, 3.7303242501751486, 2.5], // Gent zuid 2
        [51.048385140616986, 3.730919955276259, 2.5], // Gent zuid 3
        [51.04781332570135, 3.7303401934441927, 2], // gent zuid 4
        [51.05225729859948, 3.7211706565659552, 3], // Hoornstraat
        [51.05401071767538, 3.7237770161054136, 3], // Stadhal
        [51.061866849908306, 3.721512899887578, 1.5], // AZ sint lukas
        [51.061441460799024, 3.7202439541033487, 2], //AZ Donkey republic
        [51.06026125845082, 3.7088592382838526, 3.5], // technologiecampus
        [51.02447968088664, 3.729039741749436, 3], // UZ gent auditorium
        [51.02706950904973, 3.7169142983494936, 3], // Ugent campus sterre 1
        [51.026763894187766, 3.715794738380411, 3], // Ugent campus sterre 2
        [51.02613644942942, 3.7127256623652913, 3], // Ugent campus sterre 3
        [51.02594028608195, 3.713589418977894, 3], // Ugent campus sterre 4
        [51.02458266498501, 3.710939406966212, 3], // Ugent campus sterre 5
        [51.024286165193004, 3.7102582580522228, 3], // Ugent campus sterre 6
        [51.024025283660336, 3.713331017730679, 3], // Ugent campus sterre 7
        [51.02337018596447, 3.7108856346141534, 3], // Ugent campus sterre 8
        [51.01682275240185, 3.7376095183479077, 3], // ghelamco arena
        [51.033988697853566, 3.708971183081413, 1.5], // donkey republic 1
        [51.033453429811985, 3.720483554897717, 1.5], // donkey republic 2
        [51.04077010366603, 3.744739957723732, 1.5], // donkey republic 3
        [51.03692200840254, 3.7444695333269085, 1.5], // donkey republic 4
        [51.04014986159222, 3.73235696524456, 1.5] // donkey republic 5
    ];
    var heat = L.heatLayer(heatData, { radius: 25 }).addTo(map);
});