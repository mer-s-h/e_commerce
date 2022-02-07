import React, { useState } from 'react'
import { useCookies } from 'react-cookie';
import Basket from "../components/Products/Basket"
import Products from "../components/Products/Products"

export default function Cart(props) {
    const { cartItems, onAdd, onRemove, products } = props;
    return (
        <div className="cart">
            <Basket onAdd={onAdd} onRemove={onRemove} cartItems={cartItems} />
        </div>
    )
}