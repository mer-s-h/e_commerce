import React, { useEffect, useState } from 'react';
import Form from 'react-bootstrap/Form';
import { Button } from 'react-bootstrap';
import { useCookies } from "react-cookie";
import { useNavigate } from 'react-router-dom'
import "./Profile.css"

export default function UpdateProfil() {
    const navigate = useNavigate()
    const [cookies, setCookie, removeCookie] = useCookies(['user']);
    const [email, setEmail] = useState("");
    const [error, setError] = useState("");
    const [password, setPassword] = useState("");
    const [newpassword, setNewPassword] = useState("");
    const [firstname, setFirstname] = useState("");
    const [lastname, setLastname] = useState("");

    useEffect(() => {
        var details = {
            'id': cookies.userId,
        };

        var formBody = [];
        for (var property in details) {
            var encodedKey = encodeURIComponent(property);
            var encodedValue = encodeURIComponent(details[property]);
            formBody.push(encodedKey + "=" + encodedValue);
        }
        fetch(`${process.env.REACT_APP_API_URL}/user/read`, {
            method: 'POST',
            headers: {
                "Content-Type": "application/x-www-form-urlencoded",
            }, body: formBody
        })
            .then(res => res.json())
            .then(res => {
                setEmail(res.success.email);
                setFirstname(res.success.firstname);
                setLastname(res.success.lastname);
            })
    }, [])

    const handleSubmit = (e) => {
        e.preventDefault()

        var details = {
            "id": cookies.userId,
            'firstname': firstname,
            'lastname': lastname,
            'email': email,
            'password': password,
            'newPassword': newpassword,
        };

        var formBody = [];
        for (var property in details) {
            var encodedKey = encodeURIComponent(property);
            var encodedValue = encodeURIComponent(details[property]);
            if (encodedValue !== "") {
                formBody.push(encodedKey + "=" + encodedValue);
                console.log(formBody)
            }
        }
        formBody = formBody.join("&");
        fetch(`${process.env.REACT_APP_API_URL}/user/update`, {
            method: 'POST',
            headers: {
                "Content-Type": "application/x-www-form-urlencoded",
            }, body: formBody
        })
            .then(res => res.json())
            .then(res => {
                window.location = "/profil"
            })
            .then(res => {
                if (res.error) {
                    setError("Password is incorrect");
                    alert('Your password is incorrect');
                }
                else {
                    alert('Your profile has been updated')
                    navigate("/")
                }
            })

    }

    return (
        <Form className='update' noValidate onSubmit={handleSubmit}>
            <h1>Profile</h1>
            <Form.Group className="mb-3" controlId="validationCustom03">
                <Form.Label>Firstname</Form.Label>
                <Form.Control
                    required
                    type="firstname"
                    onChange={(e) => setFirstname(e.target.value)}
                    value={firstname}
                />
            </Form.Group>
            <Form.Group className="mb-3" controlId="validationCustom03">
                <Form.Label>Lastname</Form.Label>
                <Form.Control
                    required
                    type="lastname"
                    onChange={(e) => setLastname(e.target.value)}
                    value={lastname}
                />
            </Form.Group>
            <Form.Group className="mb-3" controlId="validationCustom03">
                <Form.Label>Email</Form.Label>
                <Form.Control
                    required
                    type="email"
                    onChange={(e) => setEmail(e.target.value)}
                    value={email}
                />
            </Form.Group>
            <Form.Group className="mb-3" controlId="validationCustom04">
                <Form.Label>Password</Form.Label>
                <Form.Control
                    required
                    type="password"
                    onChange={(e) => setPassword(e.target.value)}
                />
            </Form.Group>
            <Form.Group className="mb-3" controlId="validationCustom04">
                <Form.Label>New password</Form.Label>
                <Form.Control
                    required
                    type="password"
                    onChange={(e) => setNewPassword(e.target.value)}
                />
                <p>At least 5 characters</p>
            </Form.Group>
            <div className="d-flex justify-content-center">
                <Button className="button" type="submit">Update</Button>
            </div>
        </Form>
    );
}

