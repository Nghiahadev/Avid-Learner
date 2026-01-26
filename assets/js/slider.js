(function () {
  const slider = document.querySelector(".al-slider");
  if (!slider) return;

  const slides = Array.from(slider.querySelectorAll(".al-slide"));
  const dots = Array.from(slider.querySelectorAll(".al-dot"));
  const prevBtn = slider.querySelector(".al-slider-btn.prev");
  const nextBtn = slider.querySelector(".al-slider-btn.next");

  let index = 0;
  let timer = null;
  const AUTO_MS = 4500;

  function setActive(i) {
    slides.forEach((s) => s.classList.remove("is-active"));
    dots.forEach((d) => d.classList.remove("is-active"));

    index = (i + slides.length) % slides.length;
    slides[index].classList.add("is-active");
    dots[index].classList.add("is-active");
  }

  function next() { setActive(index + 1); }
  function prev() { setActive(index - 1); }

  function startAuto() {
    stopAuto();
    timer = setInterval(next, AUTO_MS);
  }

  function stopAuto() {
    if (timer) clearInterval(timer);
    timer = null;
  }

  nextBtn?.addEventListener("click", () => { next(); startAuto(); });
  prevBtn?.addEventListener("click", () => { prev(); startAuto(); });

  dots.forEach((dot, i) => {
    dot.addEventListener("click", () => {
      setActive(i);
      startAuto();
    });
  });

  slider.addEventListener("mouseenter", stopAuto);
  slider.addEventListener("mouseleave", startAuto);

  setActive(0);
  startAuto();
})();
