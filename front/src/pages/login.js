import Form from 'react-bootstrap/Form';
import { Button } from 'react-bootstrap';
import React, { useState } from "react";
import { v4 as uuidv4 } from 'uuid';
import { useCookies } from "react-cookie";
import { useNavigate, Link } from 'react-router-dom'
import "./form.css"

export default function SignIn() {
    const navigate = useNavigate()
    const [email, setEmail] = useState("");
    const [error, setError] = useState("");
    const [password, setPassword] = useState("");

    const [cookies, setCookie, removeCookie] = useCookies();

    const handleSubmit = (e) => {
        e.preventDefault()

        var details = {
            'email': email,
            'password': password,
        };

        var formBody = [];
        for (var property in details) {
            var encodedKey = encodeURIComponent(property);
            var encodedValue = encodeURIComponent(details[property]);
            formBody.push(encodedKey + "=" + encodedValue);
        }
        formBody = formBody.join("&");
        fetch(`${process.env.REACT_APP_API_URL}/user/login`, {
            method: 'POST',
            headers: {
                "Content-Type": "application/x-www-form-urlencoded",
            }, body: formBody
        })
            .then((res) => res.json())
            .then((res) => {
                if (res.error) {
                    setError("Password or email is incorrect");
                }
                else {
                    setCookie("user", uuidv4());
                    setCookie("userId", res.success);
                    navigate("/")
                }
            })
    }

    return (
        <Form className='login' noValidate onSubmit={handleSubmit}>
            <Form.Group className="mb-3" controlId="validationCustom03">
                <h1>Login</h1>
                <Form.Control
                    required
                    type="email"
                    placeholder="Email"
                    onChange={(e) => setEmail(e.target.value)}
                    value={email}
                />
            </Form.Group>
            <Form.Group className="mb-3" controlId="validationCustom04">
                <Form.Control
                    required
                    type="password"
                    placeholder="Mot de passe"
                    onChange={(e) => setPassword(e.target.value)}
                    value={password}
                />
            </Form.Group>
            <Button type="submit">Se connecter</Button>
            <Link to="/forgotPassword">forgot password ?</Link>
            <div className="error_message">
                {error ?? error}
            </div>
        </Form>
    );
}
