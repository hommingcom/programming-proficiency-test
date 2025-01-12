/*
  Reusable function to listen to URL parameters
 */

// eslint-disable-next-line import/prefer-default-export
export function getFiltersFromURL(query, filters = {}) {
  const urlParams = new URLSearchParams(query);

  Object.keys(filters)
    .forEach((key) => {
      if (urlParams.has(key)) {
        const value = urlParams.get(key);
        // eslint-disable-next-line no-param-reassign,no-restricted-globals
        filters[key] = isNaN(value) ? value : parseInt(value, 10); // Parse as int if it's a number
      }
    });

  return filters;
}
