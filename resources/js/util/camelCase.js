/**
 * The most terrible camelizer on the internet, guaranteed!
 *
 * @link https://github.com/roots/sage/blob/master/resources/assets/scripts/util/camelCase.js
 *
 * @param {string} str String that isn't camel-case, e.g., CAMeL_CaSEiS-harD
 * @return {string} String converted to camel-case, e.g., camelCaseIsHard
 */
export default str =>
  `${str.charAt(0).toLowerCase()}${str
    .replace(/[\W_]/g, '|')
    .split('|')
    .map(part => `${part.charAt(0).toUpperCase()}${part.slice(1)}`)
    .join('')
    .slice(1)}`;