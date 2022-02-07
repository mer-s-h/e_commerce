import React, { useEffect, useState } from 'react'
import { useCookies } from 'react-cookie';
import NewProduct from '../components/Products/NewProduct';

export default function Admin() {
    const [cookies, setCookie, removeCookie] = useCookies(['user']);
    const [isAdmin, setIsAdmin] = useState(false)

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
                if (res.success.roles !== "user") {
                    setIsAdmin(true)
                }
            })
    }, [])

    return (
        <div>
            {!isAdmin ? (
                <div>
                    <h3 style={{ color: "red" }} >erreur: Vous n'etes pas un admin !</h3>
                </div>
            ) : (
                    <div>    
                            <NewProduct />
                    </div>
                )}
        </div>
    )
}
