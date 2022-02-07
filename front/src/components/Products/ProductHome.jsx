import React, { useState, useEffect } from 'react';
import Tea from '../../images/bio.jpg';
import Plante from '../../images/plante.jpg'
import { Link } from 'react-router-dom';



export default function ProductHome(props) {

    const { products } = props;
    
    console.log(products);
   

    return (
        <div >
            <div style={{ textAlign: 'center', display: 'flex',paddingBottom: '40px'}}>

                {products?.slice(0, 4).map((product) =>

                    <div style={{ textAlign: 'center'}} className='displayProduct' key={product.id}>

                        <img src={Tea} style={{ width: '75%', borderRadius: '50rem' }} />
                        <p style={{ marginTop: '0.5rem', marginBottom: '0.3rem' }}>{product.categoryProduct}</p>
                        <span style={{ fontWeight: 'bold' }}>{product.nameProduct}</span>
                        <p style={{ fontWeight: 'bold', marginTop: '0.5rem', fontSize: '0.9rem' }} >{product.price10ml} €</p>

                        <Link to={`/shopping/${product.id}`}>
                            <button style={{borderRadius: '50px'}} >Show product</button>
                        </Link>    

                    </div>
                )}

            </div>

            <div style={{ textAlign: 'center', display: 'flex',  }}>

                {products?.slice(4, 8).map((product) =>

                    <div style={{ textAlign: 'center'}} className='displayProduct' key={product.id}>

                        <img src={Tea} style={{ width: '75%', borderRadius: '50rem' }} />
                        <p style={{ marginTop: '0.5rem', marginBottom: '0.3rem' }}>{product.categoryProduct}</p>
                        <span style={{ fontWeight: 'bold' }}>{product.nameProduct}</span>
                        <p style={{ fontWeight: 'bold', marginTop: '0.5rem', fontSize: '0.9rem' }} >{product.price10ml} €</p>

                        <Link to={`/shopping/${product.id}`}>
                            <button style={{borderRadius: '50px'}} >Show product</button>
                        </Link>    

                    </div>
                )}

            </div>

        </div>
    )
}