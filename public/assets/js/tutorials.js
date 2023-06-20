window.setText=(text,target)=>{
    document.getElementById(target).innerHTML=text;
}

function showMeTheVideo(videoId,text,target) {
    var url = 'https://www.youtube.com/embed/' + videoId;
    var iframe = '<iframe width="100%" height="100%" src="' + url + '" frameborder="0" allowfullscreen></iframe>';
    document.getElementById('insertIframeHere').innerHTML = iframe;
    setText(text,target);
}