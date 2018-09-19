"use strict";

/**
 * Convert a decimal value into its binary rapresentation.
 * @param {number|string} n
 * @return {number}
 */
const binary = n => {
    n = typeof n !== "number" ? parseInt(n) : n;

    return parseInt(n.toString(2));
};

/**
 * Convert a binary value into its decimal rapresentation.
 * @param {number|string} n
 * @return {number}
 */
const decimal = n => {
    n = typeof n !== "number" ? parseInt(n) : n;

    return parseInt(n, 2);
};

/**
 * Reverse a string.
 * @param {string} s
 * @return {string}
 */
const reverse = s => {
    s = typeof s !== "string" ? s.toString() : s;

    return s.split("").reverse().join("");
};

/**
 * Convert an integer into its binary representation, reverse it and return its decimal value.
 * @param {number|string} n
 * @return {number}
 */
const decimalOfReversedBinary = n => Math.abs(decimal(reverse(binary(n))));

module.exports = {
    binary,
    decimal,
    reverse,
    decimalOfReversedBinary
};