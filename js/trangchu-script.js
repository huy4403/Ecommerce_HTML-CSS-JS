var prevScrollpos = window.pageYOffset;
window.onscroll = function () {
  var currentScrollPos = window.pageYOffset;
  if (prevScrollpos > currentScrollPos) {
    document.getElementById("header").classList.remove("hidden");
  } else {
    document.getElementById("header").classList.add("hidden");
  }
  prevScrollpos = currentScrollPos;
};

function showProduct() {
  var product = document.getElementById("product");
  var hidden = document.getElementById("hidden-clothes");
  var hidden2 = document.getElementById("hidden-account");
  if (product.style.display === "none") {
    product.style.display = "block";
    hidden.style.right = "500px";
    hidden2.style.right = "300px";
  } else {
    product.style.display = "none";
    hidden.style.right = "300px";
    hidden2.style.right = "90px";
  }
}

function hiddenItems() {
  var hiddenitems = document.getElementById("hidden-items");
  if (hiddenitems.style.display === "none") {
    hiddenitems.style.display = "flex";
  } else {
    hiddenitems.style.display = "none";
  }
}

window.addEventListener("scroll", function() {
  var scrollToTopButton = document.getElementById("scrollToTopButton");
  
  // Hiển thị nút khi cuộn xuống một phần tử cụ thể
  if (document.body.scrollTop > 20 || document.documentElement.scrollTop > 20) {
      scrollToTopButton.style.display = "block";
  } else {
      scrollToTopButton.style.display = "none";
  }
});

// Xử lý sự kiện khi nhấn nút quay lại đầu trang
document.getElementById("scrollToTopButton").addEventListener("click", function() {
  document.body.scrollTop = 0; // Safari
  document.documentElement.scrollTop = 0; // Chrome, Firefox, IE, Opera
});

function nextSlide() {
  const currentSlide = document.querySelector('input[name="bottom"]:checked');
  const nextSlide = currentSlide.nextElementSibling || document.querySelector('input[name="bottom"]:first-child');
  nextSlide.checked = true;
}

function prevSlide() {
  const currentSlide = document.querySelector('input[name="bottom"]:checked');
  const prevSlide = currentSlide.previousElementSibling || document.querySelector('input[name="bottom"]:last-child');
  prevSlide.checked = true;
}

let currentIndex = 0;
        const slides = document.querySelector('.slides');
        const totalSlides = document.querySelectorAll('.slide').length;

        function nextSlide() {
            currentIndex = (currentIndex + 1) % totalSlides;
            updateSlide();
        }

        function prevSlide() {
            currentIndex = (currentIndex - 1 + totalSlides) % totalSlides;
            updateSlide();
        }

        function updateSlide() {
            const percentage = currentIndex * -20;
            slides.style.transform = `translateX(${percentage}%)`;
        }

        function autoSlideChange() {
            nextSlide();
            setTimeout(autoSlideChange, 5000); // Change slide every 5 seconds
        }

        autoSlideChange(); // Start automatic slide change