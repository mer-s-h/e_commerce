import React, { useEffect, useRef, useState } from 'react'

const Paypal = ({ price }) => {
    const paypal = useRef()
    const [complete, setComplete] = useState("")
    useEffect(() => {
        window.paypal
            .Buttons({
                createOrder: (data, actions, err) => {
                    return actions.order.create({
                        intent: "CAPTURE",
                        purchase_units: [
                            {
                                description: "Cool looking table",
                                amount: {
                                    currency_code: "EUR",
                                    value: price,
                                },
                            },
                        ],
                    });
                },
                onApprove: async (data, actions) => {
                    const order = await actions.order.capture();
                    setComplete(`Purchase done !`);
                    
                },
                onError: (err) => {
                    setComplete(err);
                },
            })
            .render(paypal.current);
    }, []);

    return (
        <div>
            <div ref={paypal}>
                <h2 style={{color:'lightgreen'}}>{complete}</h2>
            </div>
        </div>
    )
}

export default Paypal
