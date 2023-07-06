'use client'

import ListHomeDeals from "@/components/lists/ListHomeDeals";
import ListHomeInvites from "@/components/lists/ListHomeInvites";


const people = [
    {
        name: 'Michael Foster',
        role: 'Co-Founder / CTO',
        imageUrl:
            'https://images.unsplash.com/photo-1519244703995-f4e0f30006d5?ixlib=rb-=eyJhcHBfaWQiOjEyMDd9&auto=format&fit=facearea&facepad=8&w=1024&h=1024&q=80',
    },
    {
        name: 'Lindsay Walton',
        role: 'Front-end Developer',
        imageUrl: "https://images.unsplash.com/photo-1517841905240-472988babdf9?ixlib=rb-=eyJhcHBfaWQiOjEyMDd9&auto=format&fit=facearea&facepad=8&w=1024&h=1024&q=80",
    },
    {
        name: 'Courtney Henry',
        role: 'Designer',
        imageUrl: "https://images.unsplash.com/photo-1438761681033-6461ffad8d80?ixlib=rb-=eyJhcHBfaWQiOjEyMDd9&auto=format&fit=facearea&facepad=8&w=1024&h=1024&q=80",
    },

]


export default function Dashboard() {

    return (
        <div className="bg-white">
            <main>
                <div className="py-4 my-4 overflow-hidden rounded-lg bg-gray-50 shadow-xl">
                    <div className="px-4 py-5 sm:p-6">
                        <div className="bg-white py-8 sm:py-8">
                            <div className="mx-auto max-w-7xl px-6 lg:px-8">
                                <div className="mx-auto max-w-full lg:mx-0">
                                    <div className="grid grid-cols-2 gap-4 mb-8">
                                        <div className="justify-self-start">
                                            <h2 className="text-2xl font-bold tracking-tight text-vibbra-blue-500 sm:text-2xl">Suas Ofertas</h2>
                                        </div>
                                        <div className="justify-self-end">
                                            <button
                                                type="button"
                                                className="rounded-md bg-indigo-600 px-3.5 py-2.5 text-sm font-semibold text-white shadow-sm hover:bg-indigo-500 focus-visible:outline focus-visible:outline-2 focus-visible:outline-offset-2 focus-visible:outline-indigo-600"
                                            >
                                                Criar nova oferta
                                            </button>
                                        </div>
                                    </div>
                                </div>
                                <ListHomeDeals/>
                            </div>
                        </div>
                    </div>
                </div>



                <div className="py-4 my-4 overflow-hidden rounded-lg bg-gray-50 shadow-xl">
                    <div className="px-4 py-5 sm:p-6">
                        <div className="bg-white py-8 sm:py-8">
                            <div className="mx-auto max-w-7xl px-6 lg:px-8">
                                <div className="mx-auto max-w-full lg:mx-0">
                                    <div className="grid grid-cols-2 gap-4">
                                        <div className="justify-self-start">
                                            <h2 className="text-2xl font-bold tracking-tight text-vibbra-blue-500 sm:text-2xl">Seus Convites</h2>
                                        </div>

                                        <div className="justify-self-end">
                                            <button
                                                type="button"
                                                className="rounded-md bg-indigo-600 px-3.5 py-2.5 text-sm font-semibold text-white shadow-sm hover:bg-indigo-500 focus-visible:outline focus-visible:outline-2 focus-visible:outline-offset-2 focus-visible:outline-indigo-600"
                                            >
                                                Convidar
                                            </button>
                                        </div>
                                    </div>

                                    <p className="mt-2 leading-8 text-gray-600">
                                        Ampliar com qualidade nossa rede representa melhores oportunidades de negócios confiáveis
                                    </p>
                                </div>
                                <ListHomeInvites/>
                            </div>
                        </div>
                    </div>
                </div>
            </main>
        </div>
    )
}
