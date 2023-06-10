const play = document.querySelectorAll('.play').forEach(function (item) {
    item.addEventListener('click', function () {
        document.querySelectorAll('.play').forEach(btn => btn.classList.remove('hidden'));
        document.querySelectorAll('.pause').forEach(btn => btn.classList.add('hidden'));
        item.classList.add('hidden');
        const id = item.getAttribute('data-id');
        const url = item.getAttribute('data-url');
        document.getElementById('pause_' + id).classList.remove('hidden');
        loadAudioFromURL(url);
        audioPlayer.play();
    })
})

const pause = document.querySelectorAll('.pause').forEach(function (item) {
    item.addEventListener('click', function () {
        document.querySelectorAll('.play').forEach(btn => btn.classList.remove('hidden'));
        item.classList.add('hidden');
        const id = item.getAttribute('data-id');
        document.getElementById('play_' + id).classList.remove('hidden');
        audioPlayer.pause();
    })
})

function loadAudioFromURL(url) {
    if (url != audioPlayer.src) {
        audioPlayer.src = url;
        audioPlayer.load();
    }
}

