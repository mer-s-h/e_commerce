import React, { useEffect, useState } from 'react'
import { useCookies } from 'react-cookie';
import { Route, useParams } from "react-router-dom";

const ProductDetail = (props) => {
    const [product, setProduct] = useState([])
    const [selectedValue, setSelectedValue] = useState(null)
    const [cookies, setCookie, removeCookie] = useCookies(['user']);

    const { onAdd } = props;
    const { id } = useParams();

    useEffect(() => {
        var details = {
            'id': id,
        };

        var formBody = [];
        for (var property in details) {
            var encodedKey = encodeURIComponent(property);
            var encodedValue = encodeURIComponent(details[property]);
            formBody.push(encodedKey + "=" + encodedValue);
        }
        fetch(`${process.env.REACT_APP_API_URL}/product/read/id`, {
            method: 'POST',
            headers: {
                "Content-Type": "application/x-www-form-urlencoded",
            }, body: formBody
        })
            .then(res => res.json())
            .then(res => {
                setProduct(res.product)
            })
    }, [])

    function handleChange(e) {
        removeCookie("price")
        setSelectedValue(e.target.value);
        setCookie("price", e.target.value);
    }

    return (
        <div>
            <li style={{listStyle:"none"}} className="each-product" key={product.id}>
                <h3 className="product product-name">{product.nameProduct}</h3>
                <h6 className="product product-price">{product.descriptionProduct}</h6>
                <select
                    value={selectedValue}
                    onChange={handleChange}
                >
                    <option value={null}>Select your volume</option>
                    <option value={product.price10ml}>10ml</option>
                    <option value={product.price30ml}>30ml</option>
                    <option value={product.price100ml}>100ml</option>
                </select>
                <p className="product product-price">Total price: {selectedValue} €</p>
                <button className="product-button" onClick={() => onAdd(product)}>Add to cart</button>
            </li>
        </div>
    )
}

export default ProductDetail
