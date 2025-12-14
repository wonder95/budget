import {computed, toValue} from 'vue';

export function useSpendingCategories(spendingCategories) {

    /**
     * Recursive helper function to flatten the category tree into a list of options.
     * @param {Array} categories - The current array of categories/children to process.
     * @param {number} depth - The current depth level for indentation (starts at 0).
     * @param {Array} optionsArray - The array being built (passed by reference).
     * @param {string} location - 'select' or 'table'.
     */
    const flattenCategories = (categories, depth, optionsArray, location) => {
        categories.forEach(category => {
            let item = {
                id: category.id,
                name: category.name,
                slug: category.slug,
            };

            let label = category.name;

            // 1. Calculate the prefix for visual hierarchy
            if (depth > 0) {
                // Use two spaces per level for deeper indentation
                const prefix = '  '.repeat(depth) + '- ';
                label = prefix + category.name;
            }

            // Add keys required by the Reka-UI Select component
            item.label = label;
            item.value = category.id;

            // 2. Push the item to the final array for both 'select' and 'table'
            optionsArray.push(item);

            // 3. Recurse for children, increasing the depth
            if (category.children && category.children.length > 0) {
                // Pass the location argument down in the recursion
                flattenCategories(category.children, depth + 1, optionsArray, location);
            }
        });
    };

    /**
     * Computed property that returns a function.
     */
    const getFlattenedCategories = computed(() => {
        const categories = toValue(spendingCategories) || [];

        // Return a function that accepts the location
        return (location = 'select') => {
            const options = [];

            // 1. Only add the 'No Parent' option if location is 'select'
            if (location === 'select') {
                // Ensure the 'No Parent' item uses the correct keys (value/label)
                options.push({ value: null, label: 'No Parent (Top Level)' });
            }

            // 2. Start the recursive flattening process at depth 0
            // props.spendingCategories is the array of top-level items (depth 0)
            flattenCategories(spendingCategories, 0, options, location);

            return options;
        };
    });


    return{
        flattenCategories,
        getFlattenedCategories
    }
}
