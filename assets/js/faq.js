document.addEventListener("DOMContentLoaded", () => {
  const details = document.querySelectorAll(".faq__item");
  const faqImg = document.querySelector(".faq__image");
  if (!details.length || !faqImg) return;

  const imgs = JSON.parse(faqImg.dataset.faqImgs || "[]");

  // start first img
  if (imgs[0]) {
    faqImg.style.background = `url(${imgs[0]}) no-repeat center center`;
    faqImg.style.backgroundSize = "cover";
  }

  // close others + swap image
  details.forEach((targetDetail, i) => {
    targetDetail.addEventListener("click", () => {
      details.forEach((detail) => {
        if (detail !== targetDetail) detail.removeAttribute("open");
      });

      if (imgs[i]) {
        faqImg.style.background = `url(${imgs[i]}) no-repeat center center`;
        faqImg.style.backgroundSize = "cover";
      }
    });
  });
});
