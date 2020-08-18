# laravel-shop (work in progress)

![test](https://github.com/jskrd/laravel-shop/workflows/test/badge.svg?branch=master)

## Contents

- [Contents](#contents)
- [About](#about)
- [Design](#design)
    - [API Endpoints](#api-endpoints)
        - [POST api/v1/addresses](#)
        - [GET api/v1/addresses/{address}](#)
        - [PUT api/v1/addresses/{address}](#)
        - [DELETE api/v1/addresses/{address}](#)
        - [POST api/v1/baskets](#)
        - [GET api/v1/baskets/{basket}](#)
        - [GET api/v1/baskets/{basket}/variants](#)
        - [POST api/v1/baskets/{basket}/variants/{variant}](#)
        - [GET api/v1/baskets/{basket}/variants/{variant}](#)
        - [PUT api/v1/baskets/{basket}/variants/{variant}](#)
        - [DELETE api/v1/baskets/{basket}/variants/{variant}](#)
        - [GET api/v1/countries](#)
        - [GET api/v1/countries/{country}](#)
        - [GET api/v1/discounts/{discount}](#)
        - [GET api/v1/images](#)
        - [GET api/v1/images/{image}](#)
        - [GET api/v1/images/{image}/products](#)
        - [GET api/v1/images/{image}/products/{product}](#)
        - [GET api/v1/images/{image}/variants](#)
        - [GET api/v1/images/{image}/variants/{variant}](#)
        - [GET api/v1/products](#)
        - [GET api/v1/products/{product}](#)
        - [GET api/v1/products/{product}/images](#)
        - [GET api/v1/products/{product}/variants](#)
        - [POST api/v1/orders](#)
        - [GET api/v1/orders/{order}](#)
        - [GET api/v1/variants](#)
        - [GET api/v1/variants/{variant}](#)
        - [GET api/v1/variants/{variant}/images](#)
        - [GET api/v1/variants/{variant}/zones](#)
        - [GET api/v1/variants/{variant}/zones/{zone}](#)
        - [GET api/v1/zones/](#)
        - [GET api/v1/zones/{zone}](#)
        - [GET api/v1/zones/{zone}/countries](#)
        - [GET api/v1/zones/{zone}/variants](#)
    - [Entity-Relationship Diagram](#entity-relationship-diagram)

## About

A package for Laravel based projects providing a shop web API.

## Design

### Entity-Relationship Diagram

![Image of Entity-Relationship Diagram](er-diagram.png)
