const SW=(id)=>{
    const el = document.querySelector(`#${id}`);
    const isFlex = el.style.display === 'none';
    if (isFlex){
    const element = document.getElementById(id);
    element.style.display = 'flex';
    } else {
    const element = document.getElementById(id);
    element.style.display = 'none';
    }
  }
  const SW2=(id)=>{
    const el = document.querySelector(`#${id}`);
    const isFlex = el.style.display === 'none';
    if (isFlex){
    const element = document.getElementById(id);
    element.style.display = 'block';
    } else {
    const element = document.getElementById(id);
    element.style.display = 'none';
    }
  }
const Add=()=>{ alert("Добавлено в корзину")}