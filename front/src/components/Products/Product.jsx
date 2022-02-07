import React, { useState } from 'react'
import { Link } from 'react-router-dom'
import plante from "../../images/images.jpeg"
import "./Product.css"

export default function Product(props) {

    const { product } = props;

    return (
        <div className='allproduct'>
    
            <li className="each-product" key={product.id}>
                <Link className='lien-product' to={`/shopping/${product.id}`}>
                    <h6 className="product product-name">{product.nameProduct}</h6>
                    <img className="product product-image" src={plante} className="product-image" />
                    <h6 className="product product-price">{product.price10ml}€</h6>
                    <button className='product product-button' >Show Product</button>
                </Link>
            </li>
            
        </div>
    )
}