import {
    BottomNavigation,
    BottomNavigationAction,
    Box,
    TableRow,
    TextField,
} from "@mui/material";
import PropTypes from "prop-types";

import { ThemeProvider, createTheme } from "@mui/material/styles";
import PermIdentityIcon from "@mui/icons-material/PermIdentity";
import React, { useState } from "react";
import PlaceIcon from "@mui/icons-material/Place";
import { Head, router } from "@inertiajs/react";
import { PiListStarBold } from "react-icons/pi";
import Table from "@mui/material/Table";
import TableBody from "@mui/material/TableBody";
import TableCell from "@mui/material/TableCell";
import TableContainer from "@mui/material/TableContainer";
import Paper from "@mui/material/Paper";
import Header from "@/Components/frontpage/Header";

function CustomTabPanel(props) {
    const { children, value, index, ...other } = props;

    return (
        <div
            role="tabpanel"
            hidden={value !== index}
            id={`simple-tabpanel-${index}`}
            aria-labelledby={`simple-tab-${index}`}
            {...other}
        >
            {value === index && (
                <Box sx={{ p: 3, bgcolor: "#fcfcfc" }}>{children}</Box>
            )}
        </div>
    );
}

CustomTabPanel.propTypes = {
    children: PropTypes.node,
    index: PropTypes.number.isRequired,
    value: PropTypes.number.isRequired,
};

const theme = createTheme({
    palette: {
        primary: {
            main: "#008a01",
            light: "#66b967",
            dark: "#006e01",
            contrastText: "fff",
        },
    },
});

const Nilai = ({ lowongan_ppl, flash, auth, mahasiswa }) => {
    const [value, setValue] = useState(1);

    return (
        <ThemeProvider theme={theme}>
            <Head title="Home" />
            <Header />

            <main className="flex justify-center flex-col items-center w-full px-6  lg:px-10">
                <div className="container">
                    <div className="h-32"></div>

                    <section className="bg-white w-full rounded-md px-4 py-3">
                        <div className="">
                            <p className="text-neutral-600 font-bold text-lg">
                                Nilai
                            </p>
                            <p className="text-neutral-600 font-normal text-xs">
                                {`Welcome back, ${auth.user.name} We've missed you 👋`}
                            </p>
                            <hr className="my-5" />
                            <TableContainer component={Paper} elevation={1}>
                                <Table>
                                    <TableBody>
                                        <TableRow>
                                            <TableCell
                                                sx={{
                                                    whiteSpace: "nowrap",
                                                    width: "1%",
                                                }}
                                            >
                                                Nama Mahasiswa
                                            </TableCell>
                                            <TableCell
                                                align="center"
                                                sx={{
                                                    whiteSpace: "nowrap",
                                                    width: "1%",
                                                }}
                                            >
                                                :
                                            </TableCell>
                                            <TableCell>
                                                {mahasiswa[0]["nama_mahasiswa"]}
                                            </TableCell>
                                        </TableRow>
                                        <TableRow>
                                            <TableCell
                                                sx={{
                                                    whiteSpace: "nowrap",
                                                    width: "1%",
                                                }}
                                            >
                                                NIM
                                            </TableCell>
                                            <TableCell
                                                sx={{
                                                    whiteSpace: "nowrap",
                                                    width: "1%",
                                                }}
                                                align="center"
                                            >
                                                :
                                            </TableCell>
                                            <TableCell>
                                                {mahasiswa[0]["nim"]}
                                            </TableCell>
                                        </TableRow>
                                        <TableRow>
                                            <TableCell
                                                sx={{
                                                    whiteSpace: "nowrap",
                                                    width: "1%",
                                                }}
                                            >
                                                No HP/WA
                                            </TableCell>
                                            <TableCell
                                                sx={{
                                                    whiteSpace: "nowrap",
                                                    width: "1%",
                                                }}
                                                align="center"
                                            >
                                                :
                                            </TableCell>
                                            <TableCell>
                                                {mahasiswa[0]["no_hp_wa"]}
                                            </TableCell>
                                        </TableRow>
                                        <TableRow>
                                            <TableCell
                                                sx={{
                                                    whiteSpace: "nowrap",
                                                    width: "1%",
                                                }}
                                            >
                                                Prodi
                                            </TableCell>
                                            <TableCell
                                                sx={{
                                                    whiteSpace: "nowrap",
                                                    width: "1%",
                                                }}
                                                align="center"
                                            >
                                                :
                                            </TableCell>
                                            <TableCell>
                                                {mahasiswa[0]["nama_prodi"]}
                                            </TableCell>
                                        </TableRow>
                                        <TableRow>
                                            <TableCell
                                                sx={{
                                                    whiteSpace: "nowrap",
                                                    width: "1%",
                                                }}
                                            >
                                                Nama Tempat PPL
                                            </TableCell>
                                            <TableCell
                                                sx={{
                                                    whiteSpace: "nowrap",
                                                    width: "1%",
                                                }}
                                                align="center"
                                            >
                                                :
                                            </TableCell>
                                            <TableCell>
                                                {mahasiswa[0]["nama_sekolah"]}
                                            </TableCell>
                                        </TableRow>
                                        <TableRow>
                                            <TableCell
                                                sx={{
                                                    whiteSpace: "nowrap",
                                                    width: "1%",
                                                }}
                                            >
                                                Lowongan
                                            </TableCell>
                                            <TableCell
                                                sx={{
                                                    whiteSpace: "nowrap",
                                                    width: "1%",
                                                }}
                                                align="center"
                                            >
                                                :
                                            </TableCell>
                                            <TableCell>
                                                {`PPL ${mahasiswa[0]["nama_lowongan"]}`}
                                            </TableCell>
                                        </TableRow>
                                        <TableRow>
                                            <TableCell
                                                sx={{
                                                    whiteSpace: "nowrap",
                                                    width: "1%",
                                                }}
                                            >
                                                Nilai Supervisor
                                            </TableCell>
                                            <TableCell
                                                sx={{
                                                    whiteSpace: "nowrap",
                                                    width: "1%",
                                                }}
                                                align="center"
                                            >
                                                :
                                            </TableCell>
                                            <TableCell>
                                                {
                                                    mahasiswa[0][
                                                        "nilai_supervisor_ppl"
                                                    ]
                                                }
                                            </TableCell>
                                        </TableRow>
                                        <TableRow>
                                            <TableCell
                                                sx={{
                                                    whiteSpace: "nowrap",
                                                    width: "1%",
                                                }}
                                            >
                                                Nilai Pamong
                                            </TableCell>
                                            <TableCell
                                                sx={{
                                                    whiteSpace: "nowrap",
                                                    width: "1%",
                                                }}
                                                align="center"
                                            >
                                                :
                                            </TableCell>
                                            <TableCell>
                                                {mahasiswa[0]["nilai_pamong"]}
                                            </TableCell>
                                        </TableRow>
                                    </TableBody>
                                </Table>
                            </TableContainer>
                        </div>
                    </section>
                    <div className="h-52"></div>
                </div>
            </main>
            <footer className="z-[100] ">
                <Box
                    sx={{
                        width: "100%",
                        position: "fixed",
                        bottom: 0,
                        boxShadow: "10",
                    }}
                    className="shadow-md "
                >
                    <BottomNavigation
                        showLabels
                        value={value}
                        onChange={(event, newValue) => {
                            setValue(newValue);
                        }}
                    >
                        <BottomNavigationAction
                            label="Home"
                            onClick={() => router.visit("/")}
                            icon={<PlaceIcon />}
                        />

                        <BottomNavigationAction
                            color="primary"
                            label="Nilai"
                            onClick={() => router.visit("nilai")}
                            icon={<PiListStarBold />}
                        />
                        <BottomNavigationAction
                            label="Profil"
                            onClick={() => router.visit("profil")}
                            icon={<PermIdentityIcon />}
                        />
                    </BottomNavigation>
                </Box>
            </footer>
        </ThemeProvider>
    );
};

export default Nilai;
