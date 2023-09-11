document.addEventListener("DOMContentLoaded", function () {
  const parent1 = document.querySelectorAll(".has-children-1");
  const parent2 = document.querySelectorAll(".has-children-2");
  const addIcon = document.querySelectorAll('.add-icon');

  addIcon.forEach(icon => {
    icon.style.color = window.getComputedStyle(icon.parentElement.parentElement).backgroundColor;
  })

  let toggler = 1;
  document.body.addEventListener("click", function (e) {
    parent1.forEach((item) => {
      if (e.target !== item && !item.contains(e.target)) {
        item.querySelector("ul").style.display = "none";
        item.querySelector("img").style.transform = "rotate(0deg)";
      }
    });
  });

  parent1.forEach((item) => {
    item.addEventListener("click", (e) => {
      if (toggler === 1) {
        item.querySelector("ul").style.display = "flex";
        item.querySelector("img").style.transform = "rotate(180deg)";
        toggler = 0;
      } else {
        if (!item.querySelector("ul").contains(e.target)) {
          item.querySelector("ul").style.display = "none";
          item.querySelector("img").style.transform = "rotate(0deg)";
          toggler = 1;
        }
      }
    });
  });


  let toggle = 1;

  parent2.forEach((item) => {
    item.addEventListener("click", () => {
      if (toggle === 1) {
        parent2.forEach(
          (item) => (item.querySelector("ul").style.display = "none")
        );
        item.querySelector("ul").style.display = "block";
        toggle = 0;
      } else {
        parent2.forEach(
          (item) => (item.querySelector("ul").style.display = "none")
        );
        toggle = 1;
      }
    });
    item.addEventListener("mouseenter", () => {
      parent2.forEach(
        (item) => (item.querySelector("ul").style.display = "none")
      );
      item.querySelector("ul").style.display = "block";
    });
  });

  const header_2 = document.querySelector(".site-header2");
  const ul2 = header_2.querySelector(".links");
  const toggleBtn = document.getElementById("toggleMenu");
  toggleBtn.addEventListener("click", () => {
    ul2.classList.toggle("active");
  });
  
  const observer = new IntersectionObserver(entries => {
    entries.forEach(entry => {
      if(entry.isIntersecting){
        entry.target.classList.add('fire-ani');
      }
    })
  })
  const animatedElements = document.querySelectorAll('.hidden-ani');

  animatedElements.forEach(element => observer.observe(element));

});
