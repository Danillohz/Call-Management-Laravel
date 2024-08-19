function getSelectedValue() {
    document.addEventListener('DOMContentLoaded', function () {
        const deleteCategoryForm = document.getElementById('delete-category-form');
        const selectCategory = document.getElementById('category_id');

        selectCategory.addEventListener('change', function () {
            const selectedCategoryId = selectCategory.value;
            const formAction = `/categories/${selectedCategoryId}`;
            deleteCategoryForm.setAttribute('action', formAction);
        });
    });
}