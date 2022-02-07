import React, { useState } from 'react'
import { useCookies } from 'react-cookie';
import { Button } from 'react-bootstrap';
import Form from 'react-bootstrap/Form';
import { useNavigate } from 'react-router-dom'
import "./Profile.css"

export const DeleleteProfil = () => {
    const navigate = useNavigate()
    const [error, setError] = useState("")
    const [cookies, setCookie, removeCookie] = useCookies(['user']);
    const [password, setPassword] = useState("");

    function handleLogout() {
        removeCookie("user")
        removeCookie("userId")
    }

    const handleSubmit = (e) => {
        e.preventDefault()

        var details = {
            "id": cookies.userId,
            'password': password,
        };

        var formBody = [];
        for (var property in details) {
            var encodedKey = encodeURIComponent(property);
            var encodedValue = encodeURIComponent(details[property]);
            formBody.push(encodedKey + "=" + encodedValue);
        }
        formBody = formBody.join("&");
        fetch(`${process.env.REACT_APP_API_URL}/user/delete`, {
            method: 'POST',
            headers: {
                "Content-Type": "application/x-www-form-urlencoded",
            }, body: formBody
        })
        .then(res => res.json())
        .then(res => {
            if (res.error) {
                setError("Password is incorrect");
                alert('Your password is incorrect');
            }
            else {
                setCookie("userId", res.success);
                navigate("/")
            }
        })
    }
    
    return (
        <div>
            <br />
            <Form className='delete' noValidate onSubmit={handleSubmit}>
                <p>Enter the password to delete the account</p>
                <Form.Group className="mb-3" controlId="validationCustom04">
                    <Form.Control
                        required
                        type="password"
                        placeholder="Password"
                        onChange={(e) => setPassword(e.target.value)}
                        value={password}
                    />
                </Form.Group>
                <div className="d-flex justify-content-center">
                    <Button className="button" type="submit" onClick={handleLogout}>Delete my Profil</Button>
                </div>
            </Form>
        </div>
    )
}
