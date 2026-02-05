(() => {
  const items = document.querySelectorAll('[data-animate="timeline"]');
  const lineFill = document.querySelector('.al-timeline-line-fill');

  if (!items.length) return;

  const io = new IntersectionObserver((entries) => {
    entries.forEach((entry) => {
      if (entry.isIntersecting) {
        entry.target.classList.add('is-inview');

        // update line fill to current progress (simple: based on how many items revealed)
        if (lineFill) {
          const revealed = document.querySelectorAll('[data-animate="timeline"].is-inview').length;
          const pct = Math.min(100, (revealed / items.length) * 100);
          lineFill.style.height = pct + '%';
        }
      }
    });
  }, { threshold: 0.25 });

  items.forEach((el) => io.observe(el));

  // If user reloads mid-page, fill line a bit once
  if (lineFill) {
    requestAnimationFrame(() => {
      const revealed = document.querySelectorAll('[data-animate="timeline"].is-inview').length;
      const pct = Math.min(100, (revealed / items.length) * 100);
      lineFill.style.height = pct + '%';
    });
  }
})();
