let langOp = document.getElementById('language')
langOp.addEventListener('change', function() {
    // console.log(lang.value)
    location.replace('http://localhost:8080/' + langOp.value + '/Home')
})