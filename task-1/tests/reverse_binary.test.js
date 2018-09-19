"use strict";

const {binary, decimal, reverse, decimalOfReversedBinary} = require("../src/reverse_binary");
const expect = require('chai').expect;

describe("binary() function", () => {
    it("should convert a decimal number into its binary representation", () => {
        expect(binary(13)).to.equal(1101);
        expect(binary("13")).to.equal(1101);
    });
});

describe("decimal() function", () => {
    it("should convert a binary number into its decimal representation", () => {
        expect(decimal(1101)).to.equal(13);
        expect(decimal("1101")).to.equal(13);
    });
});

describe("reverse() function", () => {
    it("should reverse a string", () => {
        expect(reverse(13)).to.equal("31");
        expect(reverse("hello")).to.equal("olleh");
    });
});

describe("decimalOfReversedBinary function", () => {
    it("should convert an integer into its binary representation, reverse it and return its decimal value", () => {
        expect(decimalOfReversedBinary(13)).to.equal(11);
        expect(decimalOfReversedBinary("13")).to.equal(11);
    });
});
