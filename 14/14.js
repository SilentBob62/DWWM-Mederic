d1 = document.getElementById("d1");
d2 = document.getElementById("d2");
d3 = document.getElementById("d3");

p1=document.getElementsByClassName("sousMenu1");
p2=document.getElementsByClassName("sousMenu2");
p3=document.getElementsByClassName("sousMenu3");

for (i=0;i<p1.length;i++){
    p1[i].style.display="none";
}
for (i=0;i<p2.length;i++){
    p2[i].style.display="none";
}
for (i=0;i<p3.length;i++){
    p3[i].style.display="none";
}

d1.addEventListener("mouseover", () => {
    for (i=0;i<p1.length;i++){
    p1[i].style.display="block";
}
});

d1.addEventListener("mouseout", () => {
for (i=0;i<p1.length;i++){
    p1[i].style.display="none";
}
});

d2.addEventListener("mouseover", () => {
    for (i=0;i<p2.length;i++){
    p2[i].style.display="block";
}
});

d2.addEventListener("mouseout", () => {
for (i=0;i<p2.length;i++){
    p2[i].style.display="none";
}
});

d3.addEventListener("mouseover", () => {
    for (i=0;i<p3.length;i++){
    p3[i].style.display="block";
}
});

d3.addEventListener("mouseout", () => {
for (i=0;i<p3.length;i++){
    p3[i].style.display="none";
}
});