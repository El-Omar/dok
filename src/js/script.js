{
  let filterClosed = true;

  const init = () => {
    const $tags = document.querySelectorAll(`.filter-tag-checkbox`);
    $tags.forEach($tag => {
      $tag.addEventListener(`click`, toggleTag);
    });

    const $filterButton = document.querySelector(`.filter-toggle-button`);
    $filterButton.addEventListener(`click`, toggleFilter);

    fetch(`index.php?page=schedule&amp;t=${Date.now()}`, {
      headers: new Headers({Accept: `application/json`})
    })
    .then(r => r.json())
    .then(parse);
  };

  const parse = data => {
    console.log(data);
  };

  const toggleFilter = () => {
    filterClosed = !filterClosed;
    const $filterForm = document.querySelector(`.filter-form`);

    if (filterClosed) {
      $filterForm.classList.add(`hidden`);
      $filterForm.parentNode.classList.add(`closed`);
      $filterForm.parentNode.classList.remove(`opened`);
    } else {
      $filterForm.classList.remove(`hidden`);
      $filterForm.parentNode.classList.remove(`closed`);
      // $filterForm.classList.add(`opened`);
      $filterForm.parentNode.classList.add(`opened`);
    }

  };

  const toggleTag = e => {
    const tar = e.currentTarget;
    if (tar.checked) {
      console.log(`this checkbox is active`);
      tar.parentNode.classList.add(`active-tag`);
    } else {
      console.log(`this checkbox is not active`);
      tar.parentNode.classList.remove(`active-tag`);
    }
  };

  init();
}
