document.addEventListener("DOMContentLoaded", function () {
  document.querySelectorAll("[data-tabs]").forEach((wrap) => {
    const tabs = wrap.querySelectorAll(".tab");

    tabs.forEach((tab) => {
      tab.addEventListener("click", () => {
        const key = tab.getAttribute("data-tab");

        // remove active from all tabs + contents inside this section only
        wrap.querySelectorAll(".tab").forEach((t) => t.classList.remove("active"));
        wrap.querySelectorAll(".tab-content").forEach((c) => c.classList.remove("active"));

        // activate clicked tab + matching content by id
        tab.classList.add("active");
        const panel = wrap.querySelector(`#${key}`);
        if (panel) panel.classList.add("active");
      });
    });
  });
});
