(() => {
  const cards = document.querySelectorAll('.al-stack-card');
  if (!cards.length) return;

  const onScroll = () => {
    const viewportHeight = window.innerHeight;
    const isMobile = window.innerWidth <= 768;
    const stickyTopOffset = isMobile ? viewportHeight * 0.10 : viewportHeight * 0.15;

    cards.forEach((card, index) => {
      const nextCard = cards[index + 1];
      if (!nextCard) return;

      const nextRect = nextCard.getBoundingClientRect();
      const distance = nextRect.top - stickyTopOffset;

      if (distance < viewportHeight && distance > 0) {
        const maxShrink = isMobile ? 0.965 : 0.92;
        const factor = (1 - maxShrink) / viewportHeight;

        const scale = 1 - ((viewportHeight - distance) * factor);
        const finalScale = Math.max(maxShrink, Math.min(1, scale));
        const brightness = Math.max(0.78, Math.min(1, scale));

        card.style.transform = `scale(${finalScale})`;
        card.style.filter = `brightness(${brightness})`;
      } else if (distance <= 0) {
        const maxShrink = isMobile ? 0.965 : 0.92;
        card.style.transform = `scale(${maxShrink})`;
        card.style.filter = `brightness(0.78)`;
      } else {
        card.style.transform = 'scale(1)';
        card.style.filter = 'brightness(1)';
      }
    });
  };

  window.addEventListener('scroll', onScroll, { passive: true });
  window.addEventListener('resize', onScroll);
  onScroll();
})();
