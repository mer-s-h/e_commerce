import React, { useEffect, useState } from 'react'
import Product from "./Product"

export default function Products(props) {

    const { products, onAdd } = props;

    return (
        <div className="products">
            <ul>
                {products?.map((product) =>

                    <div>
                        <Product key={product.id} product={product} onAdd={onAdd} />  
                    </div>

                )}
            </ul>
        </div>
    )
}
