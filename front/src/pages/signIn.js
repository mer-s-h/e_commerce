import Form from 'react-bootstrap/Form';
import { Button } from 'react-bootstrap';
import React, { useState } from "react";
import { useNavigate } from 'react-router-dom'
import "./form.css"

export default function SignIn() {
    const navigate = useNavigate()
    const [firstname, setfirstname] = useState("");
    const [lastname, setlastname] = useState("");
    const [error, setError] = useState("");
    const [email, setEmail] = useState("");
    const [password, setPassword] = useState("");
    const [comfirmPassword, setComfirmPassword] = useState("");

    const onChange = (e) => {
        e.preventDefault()
        if(firstname === "") {
            alert("The fild Firstname can't be empty")
        } else { 
            if(lastname === "") {
                alert("The fild Lastname can't be empty")    
            } else {
                if(email === "") {
                    alert("The fild Email can't be empty")    
                } else {
                    if(password === ""){
                        alert("The fild Password can't be empty")    
                    } else {
                        onSubmit(e)
                    }
                }
            }
        }

    }

    const onSubmit = (e) => {
        e.preventDefault()
        if (password !== comfirmPassword) {
            alert("Passwords don't match");
        } else {
            var details = {
                'email': email,
                'password': password,
                'firstname': firstname,
                'lastname': lastname
            };

            var formBody = [];
            for (var property in details) {
                var encodedKey = encodeURIComponent(property);
                var encodedValue = encodeURIComponent(details[property]);
                formBody.push(encodedKey + "=" + encodedValue);
            }

            formBody = formBody.join("&");

            fetch(`http://localhost:3000/user/`, {
                method: 'POST',
                headers: {
                    "Content-Type": "application/x-www-form-urlencoded",
                }, body: formBody
            })
                .then((res) => {
                    navigate("/login")
                })
                .catch((err) => console.log("error: " + err));
        }
    }

    return (
        <Form className='signin' noValidate onSubmit={onChange}>
            <h1>SignIn</h1>
            <Form.Group className="mb-3" controlId="validationCustom02">
                <Form.Control
                    required
                    type="text"
                    placeholder="Firstname"
                    onChange={(e) => setfirstname(e.target.value)}
                    value={firstname}
                />
            </Form.Group>
            <Form.Group className="mb-3" controlId="validationCustom01">
                <Form.Control
                    required
                    type="text"
                    placeholder="Lastname"
                    onChange={(e) => setlastname(e.target.value)}
                    value={lastname}
                />
            </Form.Group>
            <Form.Group className="mb-3" controlId="validationCustom03">
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
                    placeholder="Password"
                    onChange={(e) => setPassword(e.target.value)}
                    value={password}
                />
            </Form.Group>
            <Form.Group className="mb-3" controlId="validationCustom04">
                <Form.Control
                    required
                    type="password"
                    placeholder="Confirm password"
                    onChange={(e) => setComfirmPassword(e.target.value)}
                    value={comfirmPassword}
                />
            </Form.Group>
            <Button type="submit">Register</Button>
            <div className="error_message">
                {error ?? error}
            </div>
        </Form>
    );
}

