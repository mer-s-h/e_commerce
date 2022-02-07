import React from 'react'
import Products from "../components/Products/Products"
import imgHuile from "../images/dessin.jpg"
import "./shopping.css"

export default function Shopping({products,onAdd}) {

    return (

        <div className='main'>
            
            <div className='imgMain'>
                <img className="imgAccueilShopping" src={imgHuile}/>
            </div>  
            <div className='mainProduct'>
            <Products products={products} onAdd={onAdd} />
            </div>
        </div>
    )
}