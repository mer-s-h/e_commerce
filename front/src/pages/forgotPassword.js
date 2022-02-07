import Form from 'react-bootstrap/Form';
import { Button } from 'react-bootstrap';
import React, { useState } from "react";
import { useNavigate } from 'react-router-dom'


export default function SignIn() {
    const navigate = useNavigate()
    const [email, setEmail] = useState("");
    const [error, setError] = useState("");

    const onChange = (e) => {
        let confirmation = window.confirm("this will change your password to a rondom password who will be send with an email \n are you sure you want to change it ?");
         if (confirmation == true) {
             alert ("an email with your new password was send check your email !");
             handleSubmit(e)
         }
    }


    const handleSubmit = (e) => {
        e.preventDefault()

        var details = {
            'email': email,
        };

        var formBody = [];
        for (var property in details) {
            var encodedKey = encodeURIComponent(property);
            var encodedValue = encodeURIComponent(details[property]);
            formBody.push(encodedKey + "=" + encodedValue);
        }
        formBody = formBody.join("&");
        fetch(`${process.env.REACT_APP_API_URL}/user/forgot`, {
            method: 'POST',
            headers: {
                "Content-Type": "application/x-www-form-urlencoded",
            }, body: formBody
        })
            .then((res) => res.json())
            .then((res) => {
                navigate("/login")
            })
            .catch((err) => console.log("error: " + err));
        setError("You can now login !");
    }

    return (
        <Form className='login' noValidate onSubmit={onChange}>
            <Form.Group className="mb-3" controlId="validationCustom03">
                <h1>Forgot password</h1>
                <Form.Control
                    required
                    type="email"
                    placeholder="Email"
                    onChange={(e) => setEmail(e.target.value)}
                    value={email}
                />
            </Form.Group>

            <Button type="submit">send email</Button>
        </Form>
    );
}
