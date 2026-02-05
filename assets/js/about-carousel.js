(() => {
  const lerp = (f0, f1, t) => (1 - t) * f0 + t * f1;
  const clamp = (val, min, max) => Math.max(min, Math.min(val, max));

  class DragScroll {
    constructor(root) {
      this.$el = root;
      this.$wrap = this.$el.querySelector(".al-carousel__wrap");
      this.$items = this.$el.querySelectorAll(".al-carousel__item");
      this.$bar = this.$el.querySelector(".al-carousel__bar");

      if (!this.$wrap || !this.$items.length || !this.$bar) return;

      this.progress = 0;
      this.speed = 0;
      this.oldX = 0;
      this.x = 0;
      this.playrate = 0;

      this.dragging = false;
      this.startX = 0;

      this.bind();
      this.events();
      this.calculate();
      this.loop();
    }

    bind() {
      [
        "calculate",
        "handleWheel",
        "handleStart",
        "handleMove",
        "handleEnd",
        "raf",
        "loop",
      ].forEach((fn) => (this[fn] = this[fn].bind(this)));
    }

    calculate() {
      const first = this.$items[0];
      const itemW = first ? first.getBoundingClientRect().width : 0;

      this.wrapWidth = itemW * this.$items.length;
      this.$wrap.style.width = this.wrapWidth + "px";
      this.maxScroll = Math.max(0, this.wrapWidth - this.$el.clientWidth);

      this.progress = clamp(this.progress, 0, this.maxScroll);
    }

    // ✅ Wheel works globally (no hover needed)
    // Only hijack scroll if carousel is in view AND can still scroll horizontally
    handleWheel(e) {
      // ignore wheel while dragging
      if (this.dragging) return;

      const rect = this.$el.getBoundingClientRect();

      // inView window (tweak if needed)
      const inView =
        rect.top < window.innerHeight * 0.8 &&
        rect.bottom > window.innerHeight * 0.2;

      if (!inView) return; // let page scroll normally

      // if carousel doesn't need scrolling, do nothing
      if (this.maxScroll <= 0) return;

      const atStart = this.progress <= 0;
      const atEnd = this.progress >= this.maxScroll;
      const goingDown = e.deltaY > 0;

      // Only hijack wheel if we can move the carousel in that direction
      const canMove =
        (!atEnd && goingDown) || (!atStart && !goingDown);

      if (!canMove) return; // allow normal page scroll at edges

      e.preventDefault();
      this.progress += e.deltaY;
      this.progress = clamp(this.progress, 0, this.maxScroll);
    }

    handleStart(e) {
      this.dragging = true;
      this.startX =
        e.clientX || (e.touches && e.touches[0].clientX) || 0;
      this.$el.classList.add("is-dragging");
    }

    handleMove(e) {
      if (!this.dragging) return;

      const x =
        e.clientX || (e.touches && e.touches[0].clientX) || 0;

      this.progress += (this.startX - x) * 2.2;
      this.startX = x;

      this.progress = clamp(this.progress, 0, this.maxScroll);
    }

    handleEnd() {
      this.dragging = false;
      this.$el.classList.remove("is-dragging");
    }

    events() {
      window.addEventListener("resize", this.calculate);

      // Attach wheel on window so user doesn’t need to hover
      window.addEventListener("wheel", this.handleWheel, { passive: false });

      // Touch drag
      this.$el.addEventListener("touchstart", this.handleStart, { passive: true });
      window.addEventListener("touchmove", this.handleMove, { passive: true });
      window.addEventListener("touchend", this.handleEnd);

      // Mouse drag
      this.$el.addEventListener("mousedown", this.handleStart);
      window.addEventListener("mousemove", this.handleMove);
      window.addEventListener("mouseup", this.handleEnd);
      document.addEventListener("mouseleave", this.handleEnd);
    }

    raf() {
      this.x = lerp(this.x, this.progress, 0.10);
      this.playrate = this.maxScroll ? this.x / this.maxScroll : 0;

      this.$wrap.style.transform = `translateX(${-this.x}px)`;
      this.$bar.style.transform = `scaleX(${0.18 + this.playrate * 0.82})`;

      this.speed = Math.min(100, this.oldX - this.x);
      this.oldX = this.x;

      this.$items.forEach((item) => {
        item.style.transform = `scale(${1 - Math.abs(this.speed) * 0.0018})`;
        const img = item.querySelector("img");
        if (img) img.style.transform = `scaleX(${1 + Math.abs(this.speed) * 0.0035})`;
      });
    }

    loop() {
      requestAnimationFrame(this.loop);
      this.raf();
    }
  }

  const init = () => {
    document
      .querySelectorAll("[data-al-carousel]")
      .forEach((el) => new DragScroll(el));
  };

  if (document.readyState === "loading") {
    document.addEventListener("DOMContentLoaded", init);
  } else {
    init();
  }
})();
