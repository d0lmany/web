const SH=(id)=>{document.getElementById("h").innerText=document.getElementById(id).innerText;}
/*--------------------------------------------*/
  const s=document.getElementById("skok");
  let num=1; 
  const min=()=>{
     num--;
     s.setAttribute("value",`${num}`);
  }
  const plu=()=>{
    num++;
    s.setAttribute("value",`${num}`);
 }
  /*--------------------------------------------*/