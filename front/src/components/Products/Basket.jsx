import React, { useState } from 'react'
import { useCookies } from 'react-cookie';
import Paypal from './Paypal';

export default function Basket(props) {
    const [cookies, setCookie, removeCookie] = useCookies(['user']);
    const [checkout, setCheckout] = useState(false)
    const { cartItems, onAdd, onRemove } = props;
    const itemsPrice = cartItems.reduce((a, c) => a + c.qty * c.price10ml, 0);
    const taxPrice = itemsPrice * 0.14;
    const shippingPrice = itemsPrice > 25 ? 0 : 5;
    const totalPrice = itemsPrice + taxPrice;
    return (
        <div style={{ border: "2px solid red" }}>
            <h2>Cart Items / Basket</h2>
            {cartItems.length === 0 && <div>Cart is empty</div>}
            {cartItems.map((item) => (
                <div key={item.id} className="cart-row">
                    <div className="">{item.nameProduct}</div>
                    <div className="">
                        <button onClick={() => onRemove(item)} className="remove">-</button>
                        <button onClick={() => onAdd(item)} className="add">+</button>
                    </div>
                    <div className="">
                        {item.qty} x ${item.price10ml.toFixed(2)}
                    </div>
                </div>
            ))}
            {cartItems.length !== 0 && (
                <>
                    <hr></hr>
                    <div className="row">
                        <div className="">Items Price {itemsPrice.toFixed(2)}€</div>
                    </div>
                    <div className="row">
                        <div className="">Tax Price ${taxPrice.toFixed(2)}</div>
                    </div>
                    <div className="">
                        <p>Shipping price ${shippingPrice}</p>
                    </div>
                    <div className="row">
                        <div className="">
                            <strong>Total Price</strong>
                        </div>
                        <div className="">
                            <strong>${totalPrice.toFixed(2)}</strong>
                        </div>
                    </div>
                    <hr />
                    <div className="row">
                        {checkout ? (
                            <Paypal price={totalPrice.toFixed(2)} />
                        ) : (
                                <button onClick={() => setCheckout(true)}>
                                    Checkout
                                </button>
                            )}
                    </div>
                </>
            )
            }
        </div >
    )
}