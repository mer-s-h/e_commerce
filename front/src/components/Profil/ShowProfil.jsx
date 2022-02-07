import React, { useEffect, useState } from 'react';
import { useCookies } from 'react-cookie';
import "./Profile.css"

export default function ShowProfil() {
    const [cookies, setCookie, removeCookie] = useCookies(['user']);
    const [email, setEmail] = useState("");
    const [password, setPassword] = useState("");
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

    return (
        <div className='show'>
            <h1>Hello {firstname} {lastname} ! </h1>
            <p>
                Welcome to your Bioflore space. In this little cocoon,
                find your wishlist, your orders and your vouchers.
                Breathe, take your time and savor this vegetal and beneficial interlude.
            </p>
            {/* <ul>
                <li>Firstname: {firstname}</li>
                <li>Lastname: {lastname}</li>
                <li>Email: {email}</li>
            </ul> */}
        </div>
    );
}