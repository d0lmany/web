let file
function magic(){
    file = document.getElementById("picture").files[0]
    if(file){
        let box = document.getElementById("img"), el = document.createElement("img")
        el.src = URL.createObjectURL(file); box.innerHTML=""
        el.name = "photo"
        box.append(el); URL.revokeObjectURL(file)
    }
}
function del(){
    document.getElementById("img").innerHTML=`Загрузите изображение или сделайте новое
            <input type="file" name="picture" id="picture" accept="image/jpg,image/png,image/jpeg" required onchange="magic()">`
            file = null
}
document.getElementById("upload").addEventListener("submit",function(event){
    event.preventDefault();
    const data = new FormData(this);
    fetch("upload.php",{
        method: "POST",
        body: data
    })
    .then(response => response.json())
    .then(data => {
        if(data.success){
            window.location.href = `sight.php?id=${data.id}`;
        } else {
            alert("Ошибка: "+data.message);
        }
    })
    .catch(error => {
        console.error("Ошибка: "+error);
        alert('Произошла ошибка при загрузке изображения.');
    });
});