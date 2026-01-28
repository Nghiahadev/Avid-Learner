(function () {
  // Helper: animate counter
  function animateCount(el, end, duration = 1100) {
    const start = 0;
    const isFloat = String(end).includes(".");
    const target = parseFloat(end);

    const startTime = performance.now();

    function tick(now) {
      const t = Math.min(1, (now - startTime) / duration);
      // easeOutCubic
      const eased = 1 - Math.pow(1 - t, 3);

      const value = start + (target - start) * eased;

      el.textContent = isFloat ? value.toFixed(1) : Math.round(value).toString();

      if (t < 1) requestAnimationFrame(tick);
      else el.textContent = isFloat ? target.toFixed(1) : Math.round(target).toString();
    }

    requestAnimationFrame(tick);
  }

  // Reveal + counters on view
  const section = document.querySelector(".al-why");
  if (!section) return;

  const revealEls = section.querySelectorAll(".al-reveal");
  const staggerEls = section.querySelectorAll(".al-stagger");
  const counters = section.querySelectorAll(".al-counter");

  let countersPlayed = false;

  const io = new IntersectionObserver(
    (entries) => {
      entries.forEach((entry) => {
        if (!entry.isIntersecting) return;

        // reveal blocks
        revealEls.forEach((el) => el.classList.add("is-visible"));

        // stagger benefits
        staggerEls.forEach((el) => {
          const delayIndex = parseInt(el.getAttribute("data-delay") || "0", 10);
          el.style.transitionDelay = `${delayIndex * 90}ms`;
          el.classList.add("is-visible");
        });

        // counters (only once)
        if (!countersPlayed) {
          countersPlayed = true;
          counters.forEach((c) => {
            const end = c.getAttribute("data-end") || "0";
            animateCount(c, end, 1200);
          });
        }
      });
    },
    { threshold: 0.25 }
  );

  io.observe(section);
})();
