// PAIS

$(document).ready(function () {
    $("#filtroInput").on("keyup", function () {
        var value = $(this).val().toLowerCase();
        $("#channelsList div").filter(function () {
            $(this).toggle($(this).text().toLowerCase().indexOf(value) > -1);
        });
    });
});

// PAÍS

// $(document).ready(function () {
//     $("#countrySearch").on("keyup", function () {
//         var value = $(this).val().toLowerCase();
//         $("#countryList div").filter(function () {
//             $(this).toggle($(this).text().toLowerCase().indexOf(value) > -1);
//         });
//     });
// });

// CATEGORIA

$(document).ready(function () {
    $("#categorySearch").on("keyup", function () {
        var value = $(this).val().toLowerCase();
        $("#categoryList div").filter(function () {
            $(this).toggle($(this).text().toLowerCase().indexOf(value) > -1);
        });
    });
});

// FILTROS CATEGORÍAS & ADULTOS


$(document).ready(function() {
    // Show all cards on page load
    showCards("all");

    // Handle category selection
    $(".dropdown-item").click(function(e) {
      e.preventDefault();
      var category = $(this).data("category");
      showCards(category);
    });
  });

  // Show/hide cards based on selected category
  function showCards(category) {
    $("#channelsList").find(".mycard").each(function() {
      var cardCategory = $(this).data("category");
      if (category == "all" || category == cardCategory) {
        $(this).show();
      } else {
        $(this).hide();
      }
    });
  }







// Get elements from the DOM
const categorySelect = document.getElementById('category-select');
const adultToggle = document.getElementById('adult-toggle');
const cards = document.querySelectorAll('.mycard');

// Filter cards by category
categorySelect.addEventListener('change', (event) => {
const selectedCategory = event.target.value;

cards.forEach((card) => {
    if (selectedCategory === '' || card.classList.contains(selectedCategory)) {
    card.style.display = 'block';
    } else {
    card.style.display = 'none';
    }
});
});

// Toggle adult channels
// adultToggle.addEventListener('change', () => {
// const showAdultChannels = adultToggle.checked;

// if (showAdultChannels) {
//     localStorage.setItem('showAdultChannels', true);
//     cards.forEach((card) => {
//     if (card.classList.contains('adult')) {
//         card.style.display = 'block';
//     }
//     });
// } else {
//     localStorage.setItem('showAdultChannels', false);
//     cards.forEach((card) => {
//     if (card.classList.contains('adult')) {
//         card.style.display = 'none';
//     }
//     });
// }
// });

// Check for user preference on page load
// const showAdultChannels = localStorage.getItem('showAdultChannels');
// if (showAdultChannels === 'true') {
// adultToggle.checked = true;
// cards.forEach((card) => {
//     if (card.classList.contains('adult')) {
//     card.style.display = 'block';
//     }
// });
// } else {
// adultToggle.checked = false;
// cards.forEach((card) => {
//     if (card.classList.contains('adult')) {
//     card.style.display = 'none';
//     }
// });
// }