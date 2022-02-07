import Form from 'react-bootstrap/Form';
import { Button } from 'react-bootstrap';
import React, { useState } from "react";
import { useCookies } from "react-cookie";
import createUtilityClassName from 'react-bootstrap/esm/createUtilityClasses';

export default function NewProduct() {
    const [name, setName] = useState("");
    const [description, setDescription] = useState("");
    const [category, setCategory] = useState("");

    const [cookies, setCookie, removeCookie] = useCookies(['user']);

    const handleSubmit = (e) => {   
        e.preventDefault()

        var details = {
            "name_product": name,
            'description_product': description,
            'category_product': category,
            'image_product': "image.png",
        };

        var formBody = [];
        for (var property in details) {
            var encodedKey = encodeURIComponent(property);
            var encodedValue = encodeURIComponent(details[property]);
            formBody.push(encodedKey + "=" + encodedValue);
        }
        formBody = formBody.join("&");
        fetch(`${process.env.REACT_APP_API_URL}/product/create`, {
            method: 'POST',
            headers: {
                "Content-Type": "application/x-www-form-urlencoded",
            }, body: formBody
        })
            .then(res => res.json())
            .then(res => console.log(res))
    }

    return (
        <Form noValidate onSubmit={handleSubmit}>
            <h1>Add a product</h1>
            <Form.Group className="mb-3" controlId="validationCustom03">
                {/* <button onClick={}>
                    <img src="" alt="" />
                </button> */}
                <Form.Control
                    required
                    type="text"
                    placeholder="Product Name"
                    onChange={(e) => setName(e.target.value)}
                    value={name}
                />
            </Form.Group>
            <Form.Group className="mb-3" controlId="validationCustom03">
                <Form.Control
                    required
                    type="text"
                    placeholder="Description"
                    onChange={(e) => setDescription(e.target.value)}
                    value={description}
                />
            </Form.Group>
            <Form.Group className="mb-3" controlId="validationCustom03">
                <Form.Control
                    required
                    type="text"
                    placeholder="Category"
                    onChange={(e) => setCategory(e.target.value)}
                    value={category}
                />
            </Form.Group>
            {/* <Form.Group className="mb-3" controlId="validationCustom04">
                <Form.Control
                    required
                    type="file"
                    placeholder="Image"
                    onChange={(e) => setImage(e.target.value)}
                    value={image}
                />
            </Form.Group> */}
            <Button type="submit">Add new product</Button>
        </Form>
    );
}

